<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Forms;
use Nette\Application\UI\Form;

class UserFormFactory {
    
    public function create(){
	$form = new Form;
	$form->setRenderer(new Bs3FormRenderer());
	$form->addText('username', 'Užívateľské meno');
	$form->addText('priezvisko', 'Priezvisko');
	$form->addText('meno', 'Meno');
	$form->addSelect('role', 'Pozícia', array('admin','user'));
	return $form;
    }
}