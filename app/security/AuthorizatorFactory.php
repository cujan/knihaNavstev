<?php

namespace App\Security;

use Nette,
    Nette\Security\Permission;

/**
 * Description of AuthorizatorFactory
 *
 * @author Holub
 */
class AuthorizatorFactory extends \Nette\Object {
    
    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    
    public function create(){
	$acl = new Permission;
	
	/**
	 * Roles 1*
	 */
	$acl->addRole(self::ROLE_GUEST);
	$acl->addRole(self::ROLE_ADMIN);
	$acl->addRole(self::ROLE_USER);//2*
	//$acl ->addRole(self::ROLE_USER,  self::ROLE_GUEST);
	//$acl->addRole(self::ROLE_USER, self::ROLE_GUEST);
	
	/**
         * Resoures 3*
         */
	$acl->addResource('Homepage');
	$acl->addResource('Sign');
	/**
         * Permissions 4*
         */
	$acl->allow(self::ROLE_GUEST,'Sign');
	$acl->allow(self::ROLE_USER, 'Homepage');
	/**$acl->allow(self::ROLE_GUEST, 'Homepage');
        $acl->allow(self::ROLE_GUEST, 'User');
	*/
	//$acl->allow(self::ROLE_GUEST,  Permission::ALL, Permission::ALL);
	$acl->allow(self::ROLE_ADMIN,  Permission::ALL, Permission::ALL);
	
	return $acl;
    }
}
