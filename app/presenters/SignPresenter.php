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
	    $fom->addHiden('zdruzenieId');
	    return $form;
	}

}
