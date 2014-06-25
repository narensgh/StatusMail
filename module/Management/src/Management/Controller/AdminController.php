<?php
namespace Management\Controller;

use Zend\Validator\Explode;

use Management\Form\AddTeamMemberForm;
use Management\Form\AddTeamForm;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Management\Service\AdminService;

class AdminController extends BaseController
{
	public function indexAction()
	{
		return new ViewModel();
	}
	public function addteamAction(){
		$addTeamForm = new AddTeamForm();
		$request = $this->getRequest();
		$serviceAdmin = new AdminService($this->getEntityManager());
		if($request->isPost()){
			$post = $request->getPost();
			$teamResponse = $serviceAdmin->addteam($post, $addTeamForm);
			if($teamResponse)
				$this->redirectTo($teamResponse);
		}
		$teamObj = $serviceAdmin->getTeams ();
		$userArray = $serviceAdmin->getTeamLeadMappings ();
		return new ViewModel ( array ('AddTeamForm' => $addTeamForm, 'teamObj' => $teamObj, 'userArray' => $userArray ) );
	
	}
	public function manageteamAction() 
	{
		$AddTeamMemberForm = new AddTeamMemberForm ( $this->getEntityManager () );
		$request = $this->getRequest ();
		$serviceAdmin = new AdminService ( $this->getEntityManager () );
		if ($request->isPost ()) 
		{
			$post = $request->getPost ();
			$mappingResponse = $serviceAdmin->mapTeam ( $post, $AddTeamMemberForm );
			if ($mappingResponse) 
			{
				$this->redirectTo ( $mappingResponse );
			}
		}
		$userMapping = $serviceAdmin->fetchUserMapping ();
		$unMappedUser = $serviceAdmin->fetchUnmappedUser();
        return new ViewModel(array('AddTeamMemberForm'=>$AddTeamMemberForm, 'userMapping' => $userMapping, 'unMappedUser' => $unMappedUser));
	}
 	public function mapTeamLeadAction()
    {
		$mappingData =  $this->getRequest()->getPost('mappingData');
       	if(!empty($mappingData))
       	{
       		list($teamId,$userId) = explode(":", $mappingData);
       		$serviceAdmin = new AdminService($this->getEntityManager());
       		$response = $serviceAdmin->mapTeamLead($teamId,$userId);
       	}
       	return new JsonModel(array('response'=>$response));
    }
}

?>