<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Libs;

/**
 * Description of AccessControl
 *
 * @author narendra.singh
 */
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class AccessControl
{

    /**
     *
     * @param \Zend\Permissions\Acl $acl
     * @param type $roles
     * @return \Zend\Permissions\Acl $acl
     */
    public function setRole (\Zend\Permissions\Acl $acl, $roles)
    {
        foreach ($roles as $role) {
            $acl->addRole(new Role($role->getRoleId()));
        }
        return $acl;
    }

    /**
     *
     * @param \Zend\Permissions\Acl $acl
     * @param type $rolePermissions
     * @return \Zend\Permissions\Acl $acl
     */
    public function setRolePermission (\Zend\Permissions\Acl $acl, $rolePermissions)
    {
        $temp = "";
        foreach ($rolePermissions as $rolePermission) {
            $resource = $rolePermission->getPermission()->getResource()->getModule();
            if ($temp !== $resource) {
                $temp = $resource;
                $acl->addResource(new Resource($resource));
            }
            $roleId = $rolePermission->getRole()->getRoleId();
            $controller = $rolePermission->getPermission()->getResource()->getResourceName();
            $action = $rolePermission->getPermission()->getPrivilege()->getPrivilegeName();
            $acl->allow($roleId, $resource, $controller . ':' . $action);
        }
        return $acl;
    }

    /**
     *
     * @param \Zend\Permissions\Acl $acl
     * @param type $targetEvent
     * @return boolean
     */
    public function isPrivilegeAllowed (\Zend\Permissions\Acl $acl, $targetEvent, $roleId = 0)
    {
        if ($acl->isAllowed($roleId, $targetEvent->module, $targetEvent->controller . ':' . $targetEvent->action)) {
            return true;
        }
    }

}
