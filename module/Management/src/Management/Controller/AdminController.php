<?php
namespace Management\Controller;

use Management\Form\AddTeamMemberForm;
use Management\Form\AddTeamForm;

use Zend\View\Model\ViewModel;

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
		$teamObj = $serviceAdmin->getTeams();
		return new ViewModel(array('AddTeamForm'=>$addTeamForm,'teamObj'=> $teamObj));

	}
	public function addteammemeberAction()
	{
		$AddTeamMemberForm = new AddTeamMemberForm($this->getEntityManager());
		return new ViewModel(array('AddTeamMemberForm'=>$AddTeamMemberForm));
	}
}

?>