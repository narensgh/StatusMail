<?php

namespace Management\Model;

use Management\Model\Entity\Team;
use Management\Model\Entity\TeamMember;
use Management\Model\Entity\User;

class Admin {

	/**
	 * 
	 * @var Doctrine\ORM\Entitymanager
	 */
	protected $_em;

	public function __construct($em){
		$this->_em = $em;
	}
	public function addteam($post)
	{
		$team = new Team();
		$team->setTeamName($post->teamName);
		$team->setTeamAbbr($post->teamAbbr);
		$this->_em->persist($team);
		$this->_em->flush();
		return $team;
	}
	public function getTeams()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb	->add('select', 't')
		->add('from', 'Management\Model\Entity\Team t');
		$result = $qb->getQuery()->getArrayResult();
		return $result;
	}
	public function getTeamDropdown()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb	->add('select', 't.teamId,t.teamAbbr')
		->add('from', 'Management\Model\Entity\Team t');
		$result = $qb->getQuery()->getArrayResult();
		return $result;
	}
public function fetchUserMapping(){
        	$qb = $this->_em->createQueryBuilder();
        	$qb->add('select', 'tm,t,u')
        	->add('from', 'Management\Model\Entity\TeamMember tm')
        	->leftJoin('tm.user', 'u')
        	->leftJoin('tm.team', 't')
        	->orderBy('u.firstName');
        	return $qb->getQuery()->getArrayResult();
		}
		public function fetchUnmappedUser(){
			$sql = "SELECT user_id as userId , first_name as firstName, last_name as lastName, '' as isLead, '' as teamId FROM user where user_id NOT IN(SELECT user_id FROM team_member)";
			$stmt = $this->_em->getConnection()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
        public function mapTeam($post)
        {
            $team = $this->_em->find('Management\Model\Entity\Team', $post->team);
            foreach ( $post->selectedTeamMember as $member){
            	$teamMember = new TeamMember();
            	$user = $this->_em->find('Management\Model\Entity\User', $member);
            	$teamMemberExist = $this->_em->getRepository('Management\Model\Entity\TeamMember')->findByUser($user);
            	print_r($teamMemberExist);die;
            	$teamMember->setTeam($team);
            	$user = $this->_em->find('Management\Model\Entity\User', $member);
	            $teamMember->setUser($user);
	            $this->_em->persist($teamMember);
            }
            $this->_em->flush();
        }
        public function teamMemberExist($team,$user)
        {
        	$teamMemberExist = $this->_em->getRepository('Management\Model\Entity\TeamMember')->findOneBy(array('team'=>$team, 'user'=>$user));
        	return $teamMemberExist;
        }
        
        public function teamLeadExixts($team)
        {
        	$teamLeadExixts= $this->_em->getRepository('Management\Model\Entity\TeamMember')->findOneBy(array('team'=>$team));
        	return $teamLeadExixts;
        }
        public function updateTeamMapping($team, $user = null, $isLead)
        {
        	$qb = $this->_em->createQueryBuilder();
        	$qb->update('Management\Model\Entity\TeamMember', 'tm')
        	->set('tm.isLead', '?1')
        	->where('tm.team = ?2');
        	if($user)
        	{
        		$qb->andWhere('tm.user = ?3');
        	}
        	$qb->setParameter(1, $isLead)
        	->setParameter(2, $team);
        	if($user)
        	{
        		$qb->setParameter(3, $user);
        	}
        	$q = $qb->getQuery();
        	$response = $q->execute();
        	return $response;
        }
        public function findTeamByTeamId($teamId)
        {
        	$team = $this->_em->find('Management\Model\Entity\Team', $teamId);
        	return $team;
        }
        public function finUserByUserId($userId)
        {
        	$user = $this->_em->find('Management\Model\Entity\User', $userId);
        	return $user;
        }
        
        public function mapTeamUserLead($team, $user, $islead)
        {
        	$teamMember = new TeamMember();
        	$teamMember->setTeam($team);
        	$teamMember->setUser($user);
        	$teamMember->setIsLead($islead);
        	$this->_em->persist($teamMember);
        	$this->_em->flush();
        	return true;
        }
        public function mapUserType($userId)
        {
        	$qb = $this->_em->createQueryBuilder();
        	$q = $qb->update('Management\Model\Entity\User', 'u')
        	->set('u.userType', '?1')
        	->where('u.userId = ?2')
        	->setParameter(1, 2)
        	->setParameter(2, $userId)
        	->getQuery();
        	$p = $q->execute();        	
        }
        public function removeTeamUser( $teamMemberExist)
        {
        	$this->_em->remove($teamMemberExist);
        	$this->_em->flush();
        }
}