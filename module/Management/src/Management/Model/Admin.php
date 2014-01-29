<?php

namespace Management\Model;

use Management\Model\Entity\Team;
use Management\Model\Entity\TeamMember;

class Admin {

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
            $qb->add('select', 'u')
               ->add('from', 'Management\Model\Entity\User u');
            return $qb->getQuery()->getArrayResult();
	}
        public function mapTeam($post)
        {
            print_r($post);die;
            $team = new Team();
            $team->setTeamName($post->teamName);
            $team->setTeamAbbr($post->teamAbbr);
            $this->_em->persist($team);
            $this->_em->flush();
            return $team;
        }
}