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
      
        }
}
