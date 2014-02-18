<?php

namespace Management\Service;

use Management\Model\Team;
use Management\Model\Admin;
use Management\Model\Status;

use Management\Form\AddTeamFilter;
use Zend\Session\Container;

class AdminService extends Common{

	protected $_em;
	protected $session;

	public function __construct($em){
		$this->_em = $em;
		$this->session = new Container('appl');
	}
	public function addteam($post, $addTeamForm)
	{
		$addTeamFilter = new AddTeamFilter();
		$addTeamForm->setInputFilter($addTeamFilter);
		$addTeamForm->setData($post);
		if ($addTeamForm->isValid()) 
		{
			$modelAdmin = new Admin($this->_em);
			$modelAdmin->addteam($post);
			return array('controller' => 'admin', 'action' => 'addteam');			
		}
	}
	public function getTeams()
	{
		$modelAdmin = new Admin($this->_em);
		$teamArr = $modelAdmin->getTeams();
		return json_decode(json_encode($teamArr, true));
	}
	public function getTeamDropdown()
	{
		$admin = new Admin($this->_em);
		$dropdownData = $admin->getTeamDropdown();
		$dropdownData = json_decode(json_encode($dropdownData, true));
		$teamDropdown = array();
		foreach ($dropdownData as $drop)
		{
			$teamDropdown[$drop->teamId] = $drop->teamAbbr;
		}
		return $teamDropdown;
	}
	private function fetchTeamUserMappings()
	{
		$admin = new Admin($this->_em);
		$userMappings = $admin->fetchUserMapping();
		$userMappings = json_decode(json_encode($userMappings, true));
		return $userMappings;
	}
        public function fetchUserMapping()
        {
        	$userMappings = $this->fetchTeamUserMappings();
        	$userMapping = array();
            foreach ($userMappings as $mapping) 
            {
            	$team = $mapping->team;
            	$user = $mapping->user;
            	$userMapping[$team->teamId][$user->userId]->teamMemberId = $mapping->teamMemberId;
            	$userMapping[$team->teamId][$user->userId]->userId = $user->userId;
            	$userMapping[$team->teamId][$user->userId]->firstName = $user->firstName;
            	$userMapping[$team->teamId][$user->userId]->lastName = $user->lastName;
            }
            return json_encode($userMapping);
        }
        public function fetchUnmappedUser()
        {
        	$admin = new Admin($this->_em);
        	return json_encode($admin->fetchUnmappedUser(),true);
        }
        public function mapTeam($post, $AddTeamMemberForm)
        {
            $modelAdmin = new Admin($this->_em);
            
            $team = $modelAdmin->findTeamByTeamId($post->team);
            $removedMember = $post->removedMember;
            if($removedMember)
            {
            	$removedMember = explode(',', $removedMember);
            }
            foreach ($removedMember as $userId)
            {
            	$user = $modelAdmin->finUserByUserId($userId);
            	$teamMemberExist = $modelAdmin->teamMemberExist($team, $user);
            	if(count($teamMemberExist) > 0)
            	{
            		$modelAdmin->removeTeamUser($teamMemberExist);
            	}            	
            }
            foreach ($post->selectedTeamMember as $userId )
            {
            	$user = $modelAdmin->finUserByUserId($userId);
            	$teamMemberExist = $modelAdmin->teamMemberExist($team, $user);
            	if(count($teamMemberExist) == 0) 
            	{
					$modelAdmin->mapTeamUserLead ( $team, $user, 0 );
				}
			}
            return array('controller' => 'admin', 'action' => 'manageteam');			
        }
        public function getTeamLeadMappings()
        {
        	$teamLeadMappings = $this->fetchTeamUserMappings();
        	$unmappedUsers = $this->fetchUnmappedUser();
        	$userMapping = array();
        	foreach ($teamLeadMappings as $leadMapping) 
            {
            	$team = $leadMapping->team;
            	$user = $leadMapping->user;
            	$userMapping[$user->userId]->userId = $user->userId;
            	$userMapping[$user->userId]->firstName = $user->firstName;
            	$userMapping[$user->userId]->isLead = $leadMapping->isLead;
            	$userMapping[$user->userId]->teamId = $leadMapping->team->teamId;
            }
            $unmappedUsers = json_decode($unmappedUsers);
            $userMapping = array_merge($userMapping, $unmappedUsers);
        	return $userMapping;
        }
        public function mapTeamLead($teamId,$userId)
        {
        	if(!empty($teamId) && !empty($userId))
        	{
        		$modelAdmin = new Admin($this->_em);
        		$team = $modelAdmin->findTeamByTeamId($teamId);
        		$user = $modelAdmin->finUserByUserId($userId);
        		$teamMemberExist = $modelAdmin->teamMemberExist($team, $user);
        		if(count($teamMemberExist)>0)
        		{
        			$teamLeadExixts = $modelAdmin->teamLeadExixts($team);
        			if(count($teamLeadExixts) > 0)
        			{
        				$response = $modelAdmin->updateTeamMapping($team, null, 0);
        				if($response)
        				{
        					$response = $modelAdmin->updateTeamMapping($team, $user, 1);
        				}
        			}
        			else
        			{
        				$response = $modelAdmin->updateTeamMapping($team, $user, 1);
        			}
        		}
        		else
        		{
        			$teamLeadExixts = $modelAdmin->teamLeadExixts($team);
        			if(count($teamLeadExixts) > 0)
        			{
        				$response = $modelAdmin->updateTeamMapping($team, null, 0);
        				if($response)
        				{
        					$response = $modelAdmin->mapTeamUserLead($team, $user, 1);
        				}
        			}
        			else
        			{
        				$response = $modelAdmin->mapTeamUserLead($team, $user, 1);
        			}
        		}        		
        		if(true == $response)
        		{
        			$modelAdmin->mapUserType($userId);
        			return "Data Saved ..!!";
        		}
        		else 
        		{
        			return "Some Error Occured ..!!";
        		}
        	}
        	else
        	{
        		return "invalid Parameter";	
        	}        	
        }
}