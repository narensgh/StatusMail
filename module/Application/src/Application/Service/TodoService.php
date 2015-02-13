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
            $todosObj = $this->_em->getRepository('Application\Model\Entity\Todo')
                ->findByTodoList(array ('todoList' => $todoList), array ('active' => 'ASC', 'dateUpdated' => 'DESC'), $limit);
        } catch (\Exception $ex) {
            throw new exception($ex->getMessage());
        }
        if (!empty($todosObj)) {
            foreach ($todosObj as $object) {
                $todo['todoListId'] = $todoListId;
                $todo['todoId'] = $object->getTodoId();
                $todo['description'] = $object->getDescription();
                $todo['assignedTo'] = $object->getAssignedTo();
                $todo['active'] = ($object->getActive() === 'true') ? true : false;
                $todo['dateUpdated'] = $object->getDateAdded()->format('jS M, Y');
                $todo['dateAdded'] = $object->getDateAdded()->format('jS M, Y');
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
        $todoList = $this->getTodoListByListId($data->todoListId);
        $todo->setTodoList($todoList);
        $todo->setDescription($data->description);
        $todo->setAssignedTo($data->assignedTo);
        $todo->setActive(($data->active)? 'true': 'false');
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
