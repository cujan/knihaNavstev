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
	$acl->addRole(self::ROLE_USER, self::ROLE_GUEST);
	$acl->addRole(self::ROLE_ADMIN);//2*
	//$acl ->addRole(self::ROLE_USER,  self::ROLE_GUEST);
	//$acl->addRole(self::ROLE_USER, self::ROLE_GUEST);
	
	/**
         * Resoures 3*
         */
	$acl->addResource('Homepage');
	$acl->addResource('Sign');
	$acl->addResource('NavstevaReviru');
	$acl->addResource('HlasenieUlovku');
	$acl->addResource('PocuteVystrely');
	$acl->addResource('ZoznamClenov');
	$acl->addResource('PrehladLovu');
	$acl->addResource('PlanLovu');
	
	/**
         * Permissions 4*
         */
	$acl->allow(self::ROLE_GUEST,'Sign');
	
	//$acl->allow(self::ROLE_USER, 'Homepage');
	//$acl->allow(self::ROLE_USER,'NavstevaReviru');
	//$acl->allow(self::ROLE_USER,'HlasenieUlovku');
	//$acl->allow(self::ROLE_USER,'PocuteVystrely');
	//$acl->allow(self::ROLE_USER,'ZoznamClenov');
	//$acl->deny(self::ROLE_USER, 'ZoznamClenov:add');
	
	/**$acl->allow(self::ROLE_GUEST, 'Homepage');
        $acl->allow(self::ROLE_GUEST, 'User');
	*/
	$acl->allow(self::ROLE_USER,  Permission::ALL, Permission::ALL);
	$acl->allow(self::ROLE_ADMIN,  Permission::ALL, Permission::ALL);
	
	$acl->deny(self::ROLE_USER, 'PlanLovu');
	
	
	
	return $acl;
    }
}
