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
/**
 * Description of NavstevaReviruPresenter
 *
 * @author Holub Ján
 */
class NavstevaReviruPresenter extends BasePresenter {
    //put your code here
     /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
	
	
    }
    public function renderDefault(){
		
        
	$this->template->records = $this->database->table('navstevaReviru')->where('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        
        $this->template->dnesneNavstevy = $this->database->table('navstevaReviru')->where('zdruzenieId = ? AND datumNavsteva = ?', $this->user->getIdentity()->zdruzenieId, date("Y:m:d"));
       
	
    }
    
    protected function createComponentPridajNavstevuForm() {
        $ucel = $this->database->table('ucelNavstevy')->fetchPairs('id','nazov');
	$lokalita = $this->database->table('lokalita')->fetchPairs('id','nazov');
	
	$form =(new \App\Forms\PridajNavstevuFormFactory())->create();
	$form->addHidden('usersId', $this->user->getId());
	$form->addHidden('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
	$form->addHidden('datumReal');
	$form->addDatePicker('datumNavsteva','Dátum návštevy')->setValue(date('d.m.Y'));
	$form->addSelect('ucelId','Účel',$ucel);
	$form->addSelect('lokalitaId','Lokalita',$lokalita);
	
	 $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        
    }
    
    public function formSucceeded($form)
	{
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    //if($postId){
		//$post = $this->database->table('navstevaReviru')->get($postId);
		//$post->update($values);
	    //}
	    
            //$this->flashMessage('Údaje boli úspešne uložené','success');
	    //$this->redirect('default');
	    
	    dump($values);
	}
    
    public function formCancel() {
	    $this->redirect('default');
	    
	}
}
