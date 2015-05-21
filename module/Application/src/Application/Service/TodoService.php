<?php

namespace Application\Service;

/**
 * Description of TodoService
 *
 * @author narendra.singh
 */
use Application\Model\Entity\Todo;

class TodoService
{

    private $_em;

    /**
     *
     * @param type $em
     */
    function __construct ($em)
    {
        if (empty($this->_em)) {
            $this->_em = $em;
        }
    }

    public function getTodo($todoId)
    {
        $todoObj = $this->getTodoById($todoId);
        $todo = array();
        $todo['todoId'] = $todoObj->getTodoId();
        $todo['description'] = $todoObj->getDescription();
        $todo['assignedTo'] = $todoObj->getAssignedTo();
        $todo['dateUpdated'] = $todoObj->getDateUpdated();
        $todo['active'] = $todoObj->getActive();
        return $todo;
    }
    /**
     *
     * @param int $todoListId
     * @param int $limit
     * @return array
     * @throws exception
     */
    public function getTodoByListId ($todoListId, $limit = null)
    {
        $todos = array ();
        $todoList = $this->getTodoListByListId($todoListId);
        try {
            $qb = $this->_em->createQueryBuilder();
            $qb->add('select', 't, partial tl.{todoListId}, partial p.{projectId}')
                    ->add('from', 'Application\Model\Entity\Todo t')
                    ->innerJoin('t.todoList', 'tl')
                    ->innerJoin('tl.project', 'p')
                    ->where('t.todoList = :todoList')
                    ->setParameter('todoList', $todoList)
                    ->orderBy('t.active, t.dateUpdated');
            $todosObj = $qb->getQuery()->getArrayResult();
        } catch (Exception $ex) {
            throw new exception($ex->getMessage());
        }
        if (!empty($todosObj)) {
            foreach ($todosObj as $object) {
                $todo['projectId'] = $object['todoList']['project']['projectId'];
                $todo['todoListId'] = $todoListId;
                $todo['todoId'] = $object['todoId'];
                $todo['description'] = $object['description'];
                $todo['assignedTo'] = $object['assignedTo'];
                $todo['active'] = ($object['active'] === 'true') ? true : false;
                $todo['dateUpdated'] = $object['dateUpdated']->format('jS M, Y');
                $todo['dateAdded'] = $object['dateAdded']->format('jS M, Y');
                $todos[] = $todo;
            }
        }
        return $todos;
    }

    /**
     *
     * @param int $todoListId
     * @return object
     */
    protected function getTodoListByListId ($todoListId)
    {
        $todoList = $this->_em->getRepository('Application\Model\Entity\TodoList')->findOneByTodoListId(array ('todoListId' => $todoListId));
        return $todoList;
    }

    /**
     *
     * @param int $todoId
     * @return object
     */
    protected function getTodoById($todoId)
    {
        $todo = $this->_em->getRepository('Application\Model\Entity\Todo')->findOneByTodoId(array ('todoId' => $todoId));
        return $todo;
    }

    /**
     *
     * @param array $data
     * @param int $todoId
     * @return \Application\Model\Entity\Todo
     */
    public function setTodo ($data, $todoId = null)
    {
        if ($todoId) {
            $todo = $this->getTodoById($todoId);
        } else {
            $todo = new Todo();
        }
        $data = (object) $data;
        $date = new \DateTime('now');
        $dueOn = new \DateTime($data->dueOn);
        $todoList = $this->getTodoListByListId($data->todoListId);
        $todo->setTodoList($todoList);
        $todo->setDescription($data->description);
        $todo->setAssignedTo($data->assignedTo);
        $todo->setDueOn($dueOn);
        $todo->setActive(($data->active) ? 'true' : 'false');
        $todo->setDateAdded($date);
        $todo->setDateUpdated($date);
        return $todo;
    }

    /**
     *
     * @param type $todo
     * @return int
     * @throws \exception
     */
    public function saveTodo ($todo)
    {
        try {
            $this->_em->persist($todo);
            $this->_em->flush();
            return $todo->getTodoId();
        } catch (\Exception $ex) {
            throw new \exception($ex->getMessage());
        }
    }

    /**
     *
     * @param int $todoId
     * @return boolean
     * @throws \exception
     */
    public function deleteTodo ($todoId)
    {
        $todo = $this->getTodoById($todoId);
        try {
            $this->_em->remove($todo);
            $this->_em->flush();
            return true;
        } catch (\Exception $ex) {
            throw new \exception($ex->getMessage());
        }
    }
}
