<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Forms;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

/**
 * Description of revirEdituj
 *
 * @author Holub
 */
class RevirEditujFormFactory  {
           
        /**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;
                $form->setRenderer(new Bs3FormRenderer());
		$form->addText('nazov', 'Názov:');
                $form->addText('vymera', 'Výmera:');
                $form->addText('polovnaOblast', 'Poľovná oblasť:');
                $form->addText('chovatelskyCelok', 'Chovateľský celok:');
                $form->addText('prislusnostOlu', 'Príslušnosť OLÚ:');
                $form->addText('prislusnostOpk', 'Príslušnosť OPK:');

		

		$form->addSubmit('send', 'Ulož');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
                
                
                
                
               
                
                
                
	}


	public function formSucceeded(Form $form, $values)
	{
            dump('super');
	}

}
