<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusController
 *
 * @author Narendra
 */

namespace Management\Controller;

use Management\Form\StatusForm;
use Management\Service\StatusService;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use ZendTest\View\Helper\Placeholder\StandaloneContainerTest;

class StatusController extends BaseController{

	private $_session;

    function __construct(){
    	$this->_session = new Container('appl');
    }

    public function indexAction(){
        $statusForm = new StatusForm($this->getEntityManager());
        if ($this->getRequest()->isPost()){
        	$post = $this->getRequest()->getPost();
        	$statusForm->setData($post);
        	if ($statusForm->isValid()){
        		$serviceStatus = new StatusService($this->getEntityManager());
        		if($post['submit'] == 'Save'){
        			$response = $serviceStatus->saveStatus($post);
        			$this->redirectTo($response);
        		}
        	}
        }
        return new ViewModel(array('statusForm'=>$statusForm));
    }

    public function reportAction(){
    	$serviceStatus = new StatusService($this->getEntityManager());
    	$userReport = $serviceStatus->getUserReport($this->_session->userId);
    	return new ViewModel(array('reportObj' => $userReport));
    }

    public function viewallreportAction(){
    	$serviceStatus = new StatusService($this->getEntityManager());
    	$reports = $serviceStatus->getAllReports();
    	return new ViewModel(array('teamUser' => json_decode(json_encode($reports, true))));
    }

    public function getUserReportAction(){
    	$request = $this->getRequest();
    	if ($request->isXmlHttpRequest()){
    		$allParams = $this->params()->fromQuery();
    		$serviceStatus = new StatusService($this->getEntityManager());
    		$userId = $request->getPost('userId');
    		$reportDate = $request->getPost('reportDate');
    		$userReport = $serviceStatus->getUserReport($userId, $reportDate);
    	}else {
    		$serviceStatus = new StatusService($this->getEntityManager());
    		$allParams = $this->params()->fromQuery();
    		$userId = $allParams['userId'];
    		$reportDate = $request->getPost('reportDate');
    		$userReport = $serviceStatus->getUserReport($userId);echo "<pre>";print_r($userReport);exit;
    	}
    	return new JsonModel(array('userReport'=>$userReport));
    }

}

?>
