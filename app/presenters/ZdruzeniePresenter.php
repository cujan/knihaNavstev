<?php

namespace App\Presenters;


use App\Model;
use Nette\Application\UI\Form;
use Nette,  
    Nette\Utils\Html;


class ZdruzeniePresenter extends BasePresenter {
    
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    
    
    public function renderDefault()
	{
	
	    $this->template->posts = $this->database->table('zdruzenie')->where('id', $this->user->getIdentity()->zdruzenieId);
                
	}
        public function renderEdit() {
            
        }
    
    public function actionEdit($id){
        $udaj = $this->database->table('zdruzenie')->get($id);
        if (!$udaj) {
        $this->error('Údaje neboli nájdené');
        }
	$this['revirEditujForm']->setDefaults($udaj);
    }

      protected function createComponentRevirEditujForm() {
        $form = (new \App\Forms\RevirEditujFormFactory())->create();
	$form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	$form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
        return $form;
        }
	
	public function formSucceeded($form)
	{
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    if($postId){
		$post = $this->database->table('zdruzenie')->get($postId);
		$post->update($values);
	    }
	    
            $this->flashMessage('Údaje boli úspešne uložené','success');
	    $this->redirect('default');
	}
	
	public function formCancel() {
	    $this->redirect('default');
	    
	}
	
	
    
}