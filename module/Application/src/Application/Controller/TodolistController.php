<?php
namespace Application\Controller;

/**
 * Description of TodolistController
 *
 * @author narendra.singh
 */

use Application\Controller\BaseController;
use Zend\View\Model\JsonModel;
use Application\Service\TodoListService;
class TodolistController extends BaseController
{
    function __construct ()
    {
        $this->setIdentifierName("todoListId");
    }

    public function get($todoListId)
    {
          return new JsonModel(array($todoListId));
    }

    public function getList ()
    {
        $projectId = $this->params()->fromQuery('projectId');
        $dataList = $this->params()->fromQuery('dataList', '');
        $todoService = new TodoListService($this->getEntityManager());
        $todoLists = $todoService->getTodoListByProjectId($projectId, $dataList);
        return new JsonModel($todoLists);
    }

    public function create($data)
    {
        $todoService = new TodoListService($this->getEntityManager());
        $todoListId = $todoService->saveTodoList($data);
        return new JsonModel(array('todoListId' => $todoListId));
    }
}
