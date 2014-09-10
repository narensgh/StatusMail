<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

/**
 * Description of PmprojectModel
 *
 * @author narendra.singh
 */

use Application\Model\Entity\PmProject;

class PmprojectModel
{
   private $_em;
    /**
     *
     * @param ORMObject $em
     */
    function __construct($em)
    {
        if(empty($this->_em)){
            $this->_em = $em;
        }
    }

    public function getProject($projectId = null)
    {
        $qb = $this->_em->createQueryBuilder();
		$qb	->add('select', 'pmp')
		->add('from', 'Application\Model\Entity\Pmproject pmp');
        if($projectId)
        {
            $qb->where('pmp.fieldId = ?')
                ->setParameter(1, $projectId);
        }
		$result = $qb->getQuery()->getArrayResult();
		return $result;
    }

    public function saveProject($data)
    {
        $date = new \DateTime('now');
        $pmProject = new PmProject();
        $pmProject->setProjectName($data['projectName']);
        $pmProject->setDateAdded($date);
        $this->_em->persist($pmProject);
        $this->_em->flush();
        return $pmProject->getProjectId();
    }
}
