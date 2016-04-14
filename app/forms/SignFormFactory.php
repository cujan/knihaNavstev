<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignFormFactory extends Nette\Object
{
	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;


	public function __construct(FormFactory $factory, User $user)
	{
		$this->factory = $factory;
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = $this->factory->create();
		$form->addText('username', 'Užívateľské meno:')
			->setRequired('Prosím vložte užívateľské meno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím vložte heslo.');

		$form->addCheckbox('remember', 'Zostať prihlásený');

		$form->addSubmit('send', 'Prihlás');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values)
	{
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}
                dump($values);
		try {
			$this->user->login($values->username, $values->password);
                        
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError('The username or password you entered is incorrect.');
		}
		
	}

}
