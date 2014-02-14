<?php

namespace Management\Model;

use Management\Model\Entity\Team;
use Management\Model\Entity\TeamMember;

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
			$sql = "SELECT user_id as userId , first_name as firstName, last_name as lastName FROM user where user_id NOT IN(SELECT user_id FROM team_member)";
			$stmt = $this->_em->getConnection()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(); 

			
			
			
// 			$qb1 = $this->_em->createQueryBuilder();
// 			$qb1->add('select', 'u.userId, u.firstName, u.lastName')
// 			->add("from", "Management\Model\Entity\User", "u");
// 			print_r($qb1->getQuery()->getArrayResult());die;
		/* 	$qb = $this->_em->createQueryBuilder();
			$qb->add('select', 'tm')
			->add('from', 'Management\Model\Entity\TeamMember tm'); */
			/* ->where('u.userId NOT IN ('.$qb1->getDQL().')')
			->orderBy('u.firstName'); */
// 			print_r($qb->getQuery()->getArrayResult());die; 
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
}