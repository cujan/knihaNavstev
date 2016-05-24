<?php

namespace App\Presenters;

use Nette;
use App\Forms\SignFormFactory,
    App\Security\AuthorizatorFactory;

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

}
