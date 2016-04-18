<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use Nette;
use App\Model;

/**
 * Description of ZoznamClenovPresenter
 *
 * @author Holub
 */
class ZoznamClenovPresenter extends BasePresenter {
    
     /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    public function renderDefault(){
		
	$this->template->records = $this->database->table('users');
	
    }
}
