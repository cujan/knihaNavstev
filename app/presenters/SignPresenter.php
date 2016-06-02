<?php

namespace App\Presenters;

use Nette;
use App\Forms\SignFormFactory,
    App\Security\AuthorizatorFactory;
use Nette\Application\UI\Form;

/**
 * @resource Sign
 */
class SignPresenter extends BasePresenter
{
    
    public function actionIn()
    {
        if ($this->user->isLoggedIn()) {
            $this->redirect('Homepage:');
        }
    }
    
	/** @var SignFormFactory @inject */
	public $factory;


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('Homepage:');
		};
		return $form;
	}


	public function actionOut()
	{
		$this->user->logout();
		$this->flashMessage('Boli ste odhlásený.');
		$this->redirect('in');
	}
	
	public function createComponentRegistrationForm(){
	    $form = new Form;
	    $form->addText('username','Užívateľské meno');
	    $form->addPassword('password', 'Heslo');
	    $form->addHidden('roleId',1);
	    $form->addText('priezvisko','Priezvisko');
	    $form->addText('meno','Meno');
	    $form->addText('email','Email');
	    $form->addHidden('zdruzenieId');
	    $form->addText('ulica','Ulica');
	    $form->addText('mesto','Mesto');
	    $form->addText('psc','PSČ');
	    $form->addText('nazov','Názov poľovného revíru');
	    
	     $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	     $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
	    
	    return $form;
	}
	
	 public function formSucceeded($form)
	{
            
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    
            dump($values);
           /**
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
           */
            
            
	}
    
    public function formCancel() {
	    $this->redirect('in');
	    
	}

}
