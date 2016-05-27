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
 * Description of PocuteVystrelyPresenter
 *
 * @author Holub
 */
/**
 * @resource PocuteVystrely
 */
class PocuteVystrelyPresenter extends BasePresenter{
  /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
	
	
    }
    
    public function renderDefault(){
		
        
	$this->template->vystrely = $this->database->table('pocuteVystrely')->where('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        
        
    }
    
    protected function createComponentPridajVystrelForm() {
        $form = new Form;
	$form->setRenderer(new \App\Forms\Bs3FormRenderer());
         
        $lokalita = $this->database->table('lokalita')->where('zdruzenieId=?',$this->user->getIdentity()->zdruzenieId)->fetchPairs('id','nazov');
        
	
        $form->addDatePicker('datum','Dátum výstrelu')->setValue(date('d.m.Y'));
        $form->addHidden('usersId', $this->user->getId());
        $form->addHidden('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        $form->addSelect('lokalitaId','Lokalita',$lokalita);
        $form->addText('pocetVystrelov','Počet výstrelov');
        $form->addText('casVystrelu','Čas výstrelu');
        
	     
         $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        
    }
    
    public function formSucceeded($form)
	{
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    if($postId){
		$post = $this->database->table('pocuteVystrely')->get($postId);
		$post->update($values);
	    }  else {
		$post = $this->database->table('pocuteVystrely')->insert($values);
		
	    }
	    
            $this->flashMessage('Údaje boli úspešne uložené','success');
	    $this->redirect('default');
            
	    
	    
	}
    
    public function formCancel() {
	    $this->redirect('default');
	    
	}
}
