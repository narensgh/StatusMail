<?php

namespace Application\Model;
/**
 * Description of PmfieldModel
 *
 * @author narendra.singh
 */

class PmfieldModel
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

    public function getFields($fieldId = null)
    {
        $qb = $this->_em->createQueryBuilder();
		$qb	->add('select', 'pmf')
		->add('from', 'Application\Model\Entity\Pmfield pmf');
        if($fieldId)
        {
            $qb->where('pmf.fieldId = ?')
                ->setParameter(1, $fieldId);
        }
		$result = $qb->getQuery()->getArrayResult();
		return $result;
    }
}
