<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use App\Model;
use Nette\Application\UI\Form;
use Nette,  
    Nette\Utils\Html;
use Nette\Forms\Container;
use Nextras\Forms\Controls;
use Nette\Utils\DateTime;

/**
 * Description of ZoznamClenovPresenter
 *
 * @author Holub
 */
/**
 * @resource ZoznamClenov
 */

class ZoznamClenovPresenter extends BasePresenter {
    
     /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    public function renderDefault(){
		
        
	$this->template->records = $this->database->table('users')->where('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
       
    }
    
    

        public function actionEdit($id){
	$osoba = $this->database->table('users')->get($id);
	if (!$osoba){
	    $this->error('Osoba nebola nájdená!!!');
	}
	
	$this['pridajClenaForm']->setDefaults($osoba);
	 
	 
    }
    
    protected function createComponentPridajClenaForm() {
        $form = new Form;
	$form->setRenderer(new \App\Forms\Bs3FormRenderer());
        
        $role = $this->database->table('role')->fetchPairs('id','nazov');
         
        $form->addText('username','Užívateľské meno');
        $form->addPassword('password','Heslo');
        $form->addSelect('roleId','Pozícia',$role);
        $form->addText('priezvisko','Priezvisko');
        $form->addText('meno','Meno');
        $form->addText('email','E-mail');
        $form->addText('telefon','Telefón');
        $form->addHidden('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        $form->addText('ulica','Ulica');
        $form->addText('mesto','Mesto');
        $form->addText('psc','PSČ');
        
	     
         $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        
    }
    
     public function formSucceeded($form)
	{
            
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    
            
           
           if($values['password']==NULL){ 
	   unset($values['password']);
	   }else{
	       $password= Nette\Security\Passwords::hash($values->password);
	       $values['password']=$password;
	   }
            
	   if($postId){
		
		$post = $this->database->table('users')->get($postId);
		$post->update($values);
	    }  else {
		$post = $this->database->table('users')->insert($values);
		
	    }
	    
            $this->flashMessage('Údaje boli úspešne uložené','success');
	    $this->redirect('default');
           
            
            
	}
    
    public function formCancel() {
	    $this->redirect('default');
	    
	}
    
}
