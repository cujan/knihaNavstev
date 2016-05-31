<?php
namespace App\Presenters;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Nette;
use App\Model;
/**
 * Description of PrehladLovuPresenter
 *
 * @author Holub Ján
 */

/**
 * @resource PrehladLovu
 */
class PrehladLovuPresenter extends BasePresenter {
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
	
	
    }
    
    public function renderDefault(){
		
        
	$this->template->plany = $this->database->table('planLovu')->where('zdruzenieId = ? AND sezonaId = ?', $this->user->getIdentity()->zdruzenieId,1);
	//jelen
	$this->template->j1 = $this->database->table('hlasenieUlovku')->where('druhZveriId=5')->count();
	$this->template->j2 = $this->database->table('hlasenieUlovku')->where('druhZveriId=6')->count();
	$this->template->j3 = $this->database->table('hlasenieUlovku')->where('druhZveriId=7')->count();
	$this->template->j4 = $this->database->table('hlasenieUlovku')->where('druhZveriId=8')->count();
	$this->template->jelenica = $this->database->table('hlasenieUlovku')->where('druhZveriId=10')->count();
	$this->template->jelenca = $this->database->table('hlasenieUlovku')->where('druhZveriId=9')->count();
	//daniel
	$this->template->d1 = $this->database->table('hlasenieUlovku')->where('druhZveriId=43')->count();
	$this->template->d2 = $this->database->table('hlasenieUlovku')->where('druhZveriId=44')->count();
	$this->template->d3 = $this->database->table('hlasenieUlovku')->where('druhZveriId=45')->count();
	$this->template->danielica = $this->database->table('hlasenieUlovku')->where('druhZveriId=46')->count();
	$this->template->danielca = $this->database->table('hlasenieUlovku')->where('druhZveriId=47')->count();
        //muflon
	$this->template->m1 = $this->database->table('hlasenieUlovku')->where('druhZveriId=48')->count();
	$this->template->m2 = $this->database->table('hlasenieUlovku')->where('druhZveriId=49')->count();
	$this->template->m3 = $this->database->table('hlasenieUlovku')->where('druhZveriId=50')->count();
	$this->template->muflonica = $this->database->table('hlasenieUlovku')->where('druhZveriId=51')->count();
	$this->template->muflonca = $this->database->table('hlasenieUlovku')->where('druhZveriId=52')->count();
	//srnec
	$this->template->s1 = $this->database->table('hlasenieUlovku')->where('druhZveriId=11')->count();
	$this->template->s2 = $this->database->table('hlasenieUlovku')->where('druhZveriId=12')->count();
	$this->template->s3 = $this->database->table('hlasenieUlovku')->where('druhZveriId=13')->count();
	$this->template->srna = $this->database->table('hlasenieUlovku')->where('druhZveriId=14')->count();
	$this->template->srnca = $this->database->table('hlasenieUlovku')->where('druhZveriId=15')->count();
	//diviak
	$this->template->dospelyDiviak = $this->database->table('hlasenieUlovku')->where('druhZveriId=1')->count();
	$this->template->dospelaDiviacica = $this->database->table('hlasenieUlovku')->where('druhZveriId=2')->count();
	$this->template->lanstiak = $this->database->table('hlasenieUlovku')->where('druhZveriId=3')->count();
	$this->template->diviaca = $this->database->table('hlasenieUlovku')->where('druhZveriId=4')->count();
	//kamzik
	$this->template->kamzik = $this->database->table('hlasenieUlovku')->where('druhZveriId=53')->count();
	$this->template->kamzica = $this->database->table('hlasenieUlovku')->where('druhZveriId=54')->count();
	
	$this->template->zajac = $this->database->table('hlasenieUlovku')->where('druhZveriId=19')->count();
	
	$this->template->bazant = $this->database->table('hlasenieUlovku')->where('druhZveriId=55')->count();
	
	
	$this->template->jariabok = $this->database->table('hlasenieUlovku')->where('druhZveriId=38')->count();

    }
}
