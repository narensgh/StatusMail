<?php
namespace Application\Service;

/**
 * Description of TodoListService
 *
 * @author narendra.singh
 *
 */
use Application\Model\Entity\TodoList;
use Application\Service\TodoService;

class TodoListService
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
     * @param int $projectId
     * @return object
     */
    public function getProjectByProjectId ($projectId)
    {
        $project = $this->_em->getRepository('Application\Model\Entity\PmProject')->findOneByProjectId(array ('projectId' => $projectId));
        return $project;
    }

    /**
     *
     * @param array $data
     * @return int
     * @throws Exception
     */
    public function saveTodoList ($data)
    {
        try {
            $todoList = new TodoList();
            $data = (object) $data;
            $date = new \DateTime('now');
            $project = $this->getProjectByProjectId($data->projectId);
            $todoList->setListname($data->listname);
            $todoList->setProject($project);
            $todoList->setDateAdded($date);
            $todoList->setDateModified($date);
            $this->_em->persist($todoList);
            $this->_em->flush();
            return $todoList->getTodoListId();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     *
     * @param int $projectId
     * @return array
     */
    public function getTodoListByProjectId ($projectId, $dataList = '')
    {
        $project = $this->getProjectByProjectId($projectId);
        $todoListObj = $this->_em->getRepository('Application\Model\Entity\TodoList')->findByProject(array ('project' => $project));
        $todoService = null;
        $todos = null;
        foreach ($todoListObj as $todoList) {
            if($dataList === 'all'){
                if(empty($todoService)){
                    $todoService = new TodoService($this->_em);
                }
                $todos = $todoService->getTodoByListId( $todoList->getTodoListId(), 5);
            }
            $list['todoListId'] = $todoList->getTodoListId();
            $list['projectId'] = $projectId;
            $list['listname'] = $todoList->getListname();
            $list['dateAdded'] = $todoList->getDateAdded()->format('Y-m-d H:i:s');
            $list['todos'] = $todos;
            $todoLists[] = $list;
        }
        return $todoLists;
    }
}
