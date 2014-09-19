<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Management\Service;

/**
 * Description of ServiceAcl
 *
 * @author narendra.singh
 */

class ServiceAcl
{

    private $_em;

    function __construct ($em)
    {
        if (empty($this->_em)) {
            $this->_em = $em;
        }
    }

    public function getAclRole ()
    {
        $roles = $this->_em->getRepository('Management\Model\Entity\AclRole')->findAll();
        return $roles;
    }

    public function getAclRolePermission()
    {
        $rolePermissions = $this->_em->getRepository('Management\Model\Entity\AclRolePermission')->findAll();
        return $rolePermissions;
    }

}
