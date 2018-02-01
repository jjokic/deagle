<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Adapter\Memory as AclList;

$acl = new AclList();

// Default action is deny access
$acl->setDefaultAction(
    Acl::DENY
);

// Create some roles.

$roles = array(
            'users' => new Phalcon\Acl\Role('Users'),
            'admin' => new Phalcon\Acl\Role('Admin'),
            'guests' => new Phalcon\Acl\Role('Guests')
        );
            foreach ($roles as $role)
            {
                $acl->addRole($role);
            }

// Admin area resources

$adminResources = array(
            'index' => array('index','addPost','delete'),
            'session' => array('start', 'end'),
            'signup' => array('submit')
        );

            foreach ($adminResources as $resource => $actions)
            {
                $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
            } 

// Public resources

$publicResources = array(
            'session' => array('start', 'end'),
            'notfound' => array('route404')
        );
            foreach ($publicResources as $resource => $actions)
            {
                $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
            }

        //Grant access to public areas to all
        foreach ($roles as $role)
        {
            foreach ($publicResources as $resource => $actions)
            {
                $acl->allow($role->getName(), $resource, '*');
            }
        }
        
//Grant access to User area to roles Users and Admin
        foreach ($adminResources as $resource => $actions)
        {
            foreach ($actions as $action)
            {
                $acl->allow('Users', $resource, $action);
                $acl->allow('Admin', $resource, $action);
            }
        }
        

// Grant DELETE twat action to legit users

$acl->allow(
    'Users',
    'index',
    'delete',
    function ($uid, $pUID) {
        return $uid == $pUID;
    }
);
