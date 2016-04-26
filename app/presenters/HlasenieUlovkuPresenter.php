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
 * Description of hlasenieUlovkuPresenter
 *
 * @author Holub Ján
 */
class HlasenieUlovkuPresenter extends BasePresenter{
     /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
	
	
    }
    
    public function renderDefault(){
		
        
	$this->template->vsetkyUlovky = $this->database->table('hlasenieUlovku')->where('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        
        $this->template->dnesneUlovky = $this->database->table('hlasenieUlovku')->where('zdruzenieId = ? AND datumUlovenia = ?', $this->user->getIdentity()->zdruzenieId, date("Y:m:d"));
       
	
    }
    
     protected function createComponentPridajUlovokForm() {
        $form = new Form;
	$form->setRenderer(new \App\Forms\Bs3FormRenderer());
         
        $ucel = $this->database->table('ucelNavstevy')->fetchPairs('id','nazov');
	$lokalita = $this->database->table('lokalita')->fetchPairs('id','nazov');
        $druhZveri = $this->database->table('druhZveri')->fetchPairs('id','nazov');
        $sposobUlovenia = $this->database->table('sposobUlovenia')->fetchPairs('id','nazov');
	
        $form->addDatePicker('datumUlovenia','Dátum ulovenia')->setValue(date('d.m.Y'));
        $form->addHidden('usersId', $this->user->getId());
        $form->addHidden('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        $form->addSelect('lokalitaId','Lokalita',$lokalita);
        $form->addSelect('druhZveriId','Druh zveri',$druhZveri);
        $form->addText('pocetKs','Počet kusov');
        $form->addSelect('sposobId','Druh zveri',$sposobUlovenia);
        $form->addText('cisloZnacky','Číslo značky');
        $form->addText('casUlovenia','Čas ulovenia');
        
	/**
	
	$form->addHidden('datumReal')->setValue(date('Y-m-d'));
	
	$form->addSelect('ucelId','Účel',$ucel);
	$form->addSelect('lokalitaId','Lokalita',$lokalita);
	$form->addSelect('prichodCas', 'čas príchodu do revíru')->setItems($intervals,FALSE);
        $form->addSelect('odchodCas', 'čas odchodu z revíru')->setItems($intervals,FALSE);
	
	 $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
         * 
         */
        
         $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        
    }
    
    public function formSucceeded($form)
	{
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    /**if($postId){
		$post = $this->database->table('navstevaReviru')->get($postId);
		$post->update($values);
	    }  else {
		$post = $this->database->table('navstevaReviru')->insert($values);
		
	    }
	    
            $this->flashMessage('Údaje boli úspešne uložené','success');
	    $this->redirect('default');
             * 
             */
	    dump($values);
	    
	}
    
    public function formCancel() {
	    $this->redirect('default');
	    
	}
}
