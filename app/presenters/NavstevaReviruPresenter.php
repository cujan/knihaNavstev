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
/**
 * Description of NavstevaReviruPresenter
 *
 * @author Holub Ján
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
       
       
	
    }
}
