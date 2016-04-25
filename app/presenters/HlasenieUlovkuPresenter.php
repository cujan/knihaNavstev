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
 * Description of hlasenieUlovkuPresenter
 *
 * @author Holub Ján
 */
class HlasenieUlovkuPresenter extends BasePresenter{
     /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
	
	
    }
    
    public function renderDefault(){
		
        
	$this->template->vsetkyUlovky = $this->database->table('hlasenieUlovku')->where('zdruzenieId', $this->user->getIdentity()->zdruzenieId);
        
        $this->template->dnesneUlovky = $this->database->table('hlasenieUlovku')->where('zdruzenieId = ? AND datumUlovenia = ?', $this->user->getIdentity()->zdruzenieId, date("Y:m:d"));
       
	
    }
}
