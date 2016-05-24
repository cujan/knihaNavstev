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
 * Description of NavstevaReviruPresenter
 *
 * @author Holub Ján
 */

/**
 * @resource NavstevaReviru
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
	$casy = array('00:00','00:30');
	
        
        $begin = new DateTime(date('d.m.Y'));
        $end = new DateTime(date('d.m.Y')); // tento čas už v poli nebude
        $end = $end->modify( '+1 day' ); 

        $interval = new \DateInterval('PT30M');
        $daterange = new \DatePeriod($begin, $interval, $end);

        $intervals = [];
        foreach($daterange as $date) {
        $intervals[] = $date->format("H:i");
        }

        $form =(new \App\Forms\PridajNavstevuFormFactory())->create();
	$form->addHidden('usersId', $this->user->getId());
	$form->addHidden('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
	$form->addHidden('datumReal')->setValue(date('Y-m-d'));
	$form->addDatePicker('datumNavsteva','Dátum návštevy')->setValue(date('d.m.Y'));
	$form->addSelect('ucelId','Účel',$ucel);
	$form->addSelect('lokalitaId','Lokalita',$lokalita);
	$form->addSelect('prichodCas', 'čas príchodu do revíru')->setItems($intervals,FALSE);
        $form->addSelect('odchodCas', 'čas odchodu z revíru')->setItems($intervals,FALSE);
	
	 $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        
    }
    
    public function formSucceeded($form)
	{
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    if($postId){
		$post = $this->database->table('navstevaReviru')->get($postId);
		$post->update($values);
	    }  else {
		$post = $this->database->table('navstevaReviru')->insert($values);
		
	    }
	    
            $this->flashMessage('Údaje boli úspešne uložené','success');
	    $this->redirect('default');
	    
	    
	}
    
    public function formCancel() {
	    $this->redirect('default');
	    
	}
}
