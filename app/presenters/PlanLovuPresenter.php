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
 * @resource PlanLovu
 */
class PlanLovuPresenter extends BasePresenter {
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
	
	
    }
    
    public function renderDefault(){
		
        
	$this->template->plany = $this->database->table('planLovu')->where('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        
        
    }
    
    public function actionEdit($id){
	$plan = $this->database->table('planLovu')->get($id);
	if (!$plan){
	    $this->error('Plán nebol nájdený!!!');
	}
	
	$this['pridajPlanForm']->setDefaults($plan);
	 
	 
    }
    
      protected function createComponentPridajPlanForm() {
        $sezona = $this->database->table('sezona')->fetchPairs('id','nazov');
	  
	  
	  
	$form = new Form;
	$form->setRenderer(new \App\Forms\Bs3FormRenderer());
        
	$form->addSelect('sezonaId','Sezóna',$sezona);
        $form->addHidden('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
	
	$form->addText('j1','Jeleň I.')->setDefaultValue(0);
	$form->addText('j2','Jeleň II.')->setDefaultValue(0);
	$form->addText('j3','Jeleň III.')->setDefaultValue(0);
	$form->addText('j4','Jeleň IV.')->setDefaultValue(0);
	$form->addText('jelenica','Jelenica')->setDefaultValue(0);
	$form->addText('jelenca','Jelienča')->setDefaultValue(0);
        
	$form->addText('d1','Daniel I.')->setDefaultValue(0);
	$form->addText('d2','Daniel II.')->setDefaultValue(0);
	$form->addText('d3','Daniel III.')->setDefaultValue(0);
	$form->addText('danielica','Danielica')->setDefaultValue(0);
	$form->addText('danielca','Danielča')->setDefaultValue(0);
	
	$form->addText('m1','Muflón I.')->setDefaultValue(0);
	$form->addText('m2','Muflón II.')->setDefaultValue(0);
	$form->addText('m3','Muflón III.')->setDefaultValue(0);
	$form->addText('muflonica','Muflónica')->setDefaultValue(0);
	$form->addText('muflonca','Muflónča')->setDefaultValue(0);
	
	$form->addText('s1','Srnec I.')->setDefaultValue(0);
	$form->addText('s2','Srnec II.')->setDefaultValue(0);
	$form->addText('s3','Srnec III.')->setDefaultValue(0);
	$form->addText('srna','Srna')->setDefaultValue(0);
	$form->addText('srnca','Srnča')->setDefaultValue(0);
	
	$form->addText('diviak','Dospelý diviak')->setDefaultValue(0);
	$form->addText('diviacica','Dspelá diviačica')->setDefaultValue(0);
	$form->addText('lanstiak','Lanštiak')->setDefaultValue(0);
	$form->addText('diviaca','Diviača')->setDefaultValue(0);
	
	$form->addText('kamzik','Kamzík')->setDefaultValue(0);
	$form->addText('kamzica','Kamzica')->setDefaultValue(0);
	$form->addText('kamzicata','Kamzíča')->setDefaultValue(0);
	
	$form->addText('zajac','Zajac')->setDefaultValue(0);
	$form->addText('jarabica','Jarabica')->setDefaultValue(0);
	$form->addText('bazant','Bažant')->setDefaultValue(0);
	$form->addText('jariabokLesny','Jariabok lesný')->setDefaultValue(0);
        
	     
         $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	 $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        
    }
    
     public function formSucceeded($form)
	{
            
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    
	    $pocet = $this->database->table('planLovu')->where('sezonaId = ? AND zdruzenieId=?', $values['sezonaId'],$values['zdruzenieId'])->count('*');
            
	    
         
	       
	   
	    if($postId){
		
		    $post = $this->database->table('planLovu')->get($postId);
		    $post->update($values);
		    $this->flashMessage('Údaje boli úspešne uložené','success');
				$this->redirect('default');
		}  else {
		    
		    if($pocet <> 0){
			dump('Plán pre túto sezónu už exituje, nemôžete vytvoriť nový...pre zmenu ho stačí editovať');
	       
		    } else {
				$post = $this->database->table('planLovu')->insert($values);
				$this->flashMessage('Údaje boli úspešne uložené','success');
				$this->redirect('default');
		    }
		    }
	    
	        
	   }
            
	
    
    public function formCancel() {
	    $this->redirect('default');
	    
	}
    
}
