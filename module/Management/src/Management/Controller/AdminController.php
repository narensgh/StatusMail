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
	public function manageteamAction()
	{
            $AddTeamMemberForm = new AddTeamMemberForm($this->getEntityManager());
            $request = $this->getRequest();
            $serviceAdmin = new AdminService($this->getEntityManager());
            if($request->isPost()){
                $post = $request->getPost();
                print_r($post);die;
                $mappiingResponse = $serviceAdmin->mapTeam($post, $AddTeamMemberForm);
                if($mappiingResponse){
                    $this->redirectTo($mappiingResponse);
                }
            }
            $userMapping = $serviceAdmin->fetchUserMapping();
            return new ViewModel(array('AddTeamMemberForm'=>$AddTeamMemberForm, 'userMapping' => $userMapping));
	}
        public function mapTeamUserAction()
        {
            
        }
}

?>