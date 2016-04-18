<?php
namespace App\Presenters;

use Nette;
use App\Model;

class UserProfilePresenter extends BasePresenter {
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    public function renderDefault(){
	$idUser = $this->user->getId();
	
	$this->template->record = $this->database->table('users')->get($idUser);
	
    }
  
    public function renderEdit($id) {
	 $udaj = $this->database->table('users')->get($id);
        if (!$udaj) {
        $this->error('Údaje neboli nájdené');
        }
	$this['userForm']->setDefaults($udaj);
      
        }
	
	protected function createComponentUserForm() {
	    $role = $this->database->table('role')->fetchPairs('id','nazov');
            
            $form = (new \App\Forms\UserFormFactory()) -> create();
            $form->addSelect('roleId', 'Pozícia',$role);
	    $form->addSubmit('send', 'Uložiť')->onClick[] =array($this,'formSucceeded') ;
	    $form->addSubmit('cancel','Storno')->onClick[] = array($this,'formCancel');
	    return $form;
	}
	
	public function formSucceeded($form)
	{
	    $values =	$form->getForm()->getValues();
	    $postId = $this->getParameter('id');
	    if($postId){
		$post = $this->database->table('users')->get($postId);
		$post->update($values);
	    }
	    
            $this->flashMessage('Údaje boli úspešne uložené','success');
	    $this->redirect('default');
	}
	
	public function formCancel() {
	    $this->redirect('default');
	    
	}
}
