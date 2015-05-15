<?php

namespace Application\Controller;

/**
 * Description of TodoController
 *
 * @author narendra.singh
 */
use Application\Controller\BaseController;
use Zend\View\Model\JsonModel;
use Application\Service\TodoService;

class TodoController extends BaseController
{

    function __construct ()
    {
        $this->setIdentifierName("todoId");
    }

    public function get ($todoId)
    {
        $todoService = new TodoService($this->getEntityManager());
        $todo = $todoService->getTodo($todoId);
        return new JsonModel(array ('todos' => $todo));
    }

    /**
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function getList ()
    {
        $todoListId = $this->params()->fromQuery('todoListId');
        $todoService = new TodoService($this->getEntityManager());
        $todos = $todoService->getTodoByListId($todoListId);
        return new JsonModel(array ('todos' => $todos));
    }

    /**
     *
     * @param type $data
     * @return \Zend\View\Model\JsonModel
     */
    public function create ($data)
    {
        $todoService = new TodoService($this->getEntityManager());
        $todo = $todoService->setTodo($data);
        $todoId = $todoService->saveTodo($todo);
        return new JsonModel(array ('todoId' => $todoId));
    }

    /**
     *
     * @param int $todoId
     * @param array $data
     * @return \Zend\View\Model\JsonModel
     */
    public function update ($todoId, $data)
    {
        $todoService = new TodoService($this->getEntityManager());
        $todo = $todoService->setTodo($data, $todoId);
        $todoId = $todoService->saveTodo($todo);
        return new JsonModel(array ('todoId' => $todoId));
    }

    /**
     *
     * @param int $todoId
     * @return \Zend\View\Model\JsonModel
     */
    public function delete ($todoId)
    {
        $todoService = new TodoService($this->getEntityManager());
        $response = $todoService->deleteTodo($todoId);
        return new JsonModel(array ('response' => $response));
    }

}
