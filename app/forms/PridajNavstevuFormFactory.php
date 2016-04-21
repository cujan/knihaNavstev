<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Forms;
use Nette\Application\UI\Form;
/**
 * Description of PridajNavstevuFormFactory
 *
 * @author Holub
 */
class PridajNavstevuFormFactory {
     
    public function create(){
	$form = new Form;
	$form->setRenderer(new Bs3FormRenderer());
	$form->addText('datumReal', 'Dátum zápisu')->setDisabled()->setValue(date('d.m.Y'));
	
	return $form;
    }
}
