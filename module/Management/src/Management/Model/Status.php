<?php

/**
 * Description of StatusModel
 *
 * @author Narendra
 */

namespace Management\Model;

use Management\Model\Entity\User;
use Management\Model\Entity\Task;
use Zend\_session\Container;

class Status {

    protected $_em;
    protected $_session;

    public function __construct($em, $session) {
        $this->_em = $em;
        $this->_session = $session;
    }

    public function saveStatus($postData) {
        $curDate = new \DateTime('now');
        $user = $this->_em->find('Management\Model\Entity\User', $this->_session->userId);
        $ticketType = $this->_em->find('Management\Model\Entity\Team', $postData->ticketType);
        $jiraTicket = $this->getJiraTicket($ticketType->getTeamAbbr() . "-" . $postData->ticketNumber, $postData);
        $status = new \Management\Model\Entity\Status();
        $status->setDescription($postData->description);
        $status->setUser($user);
        $status->setStatus($postData->status);
        $status->setTask($jiraTicket);
        $status->setDateAdded($curDate);
        $this->_em->persist($status);
        $this->_em->flush();
        return array('controller' => 'status', 'action' => 'report');
    }

    private function getJiraTicket($ticketNum, $postData) {
        $jiraTicket = $this->_em->getRepository('Management\Model\Entity\Task')->findOneByJiraTicketId($ticketNum);
        if (!$jiraTicket) {
            $jiraTicket = new Task();
            $jiraTicket->setJiraTicketId($ticketNum);
            $jiraTicket->setTitle($postData->title);
        }
        $this->_em->persist($jiraTicket);
        return $jiraTicket;
    }

    public function getUserReportData($userId, $fromDate = null, $toDate = null) {
        $qb = $this->_em->createQueryBuilder();
        $qb->add('select', 's,t,u')
                ->add('from', 'Management\Model\Entity\Status s')
                ->innerJoin('s.task', 't')
                ->innerJoin('s.user', 'u')
                ->where('s.dateAdded BETWEEN :from AND :to')
                ->andWhere('u.userId IN(:userId)')
                ->setParameter('userId', $userId)
                ->setParameter('from', $fromDate)
                ->setParameter('to', $toDate)
                ->orderBy('s.dateAdded');
        return $qb->getQuery()->getArrayResult();
    }

    public function fetchAllReports() {
        $qb = $this->_em->createQueryBuilder();
        $qb->add('select', 's,t,u')
                ->add('from', 'Management\Model\Entity\Status s')
                ->innerJoin('s.task', 't')
                ->innerJoin('s.user', 'u');
        return $qb->getQuery()->getArrayResult();
    }

    public function findUserByUserId($userId) {
        $user = $this->_em->find('Management\Model\Entity\User', $userId);
        return $user;
    }

    public function findTeamByUser($user, $isLead = null) {
        $team = $this->_em->getRepository('Management\Model\Entity\TeamMember')->findOneBy(array('user' => $user, 'isLead' => $isLead));
        return $team;
    }

    public function fetchAllUsers($teamLeadId = null) {
        $qb = $this->_em->createQueryBuilder();
        if ($teamLeadId == null) {
            $qb->add('select', 'u')
                    ->add('from', 'Management\Model\Entity\User u');
        } else {
            $user = $this->findUserByUserId($teamLeadId);
            $teamMemder = $this->findTeamByUser($user, true);
            if ($teamMemder) {
                $teamId = $teamMemder->getTeam()->getTeamId();
                $qb->add('select', 'u.userId, u.firstName')
                        ->add('from', 'Management\Model\Entity\TeamMember tm')
                        ->leftJoin('tm.user', 'u');
                $qb->where('tm.team = :team')
                        ->setParameter('team', $teamMemder->getTeam());
            } else{
               return array();
            }
        }
        $qb->orderBy('u.firstName');
        return $qb->getQuery()->getArrayResult();
    }

}
