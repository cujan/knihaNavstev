<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;


class UdajeRevirPresenter extends BasePresenter {
    
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    
    
    public function renderDefault()
	{
		$this->template->posts = $this->database->table('revirUdaje');
                
	}
    
    public function renderEdit($id){
        $udaj = $this->database->table('revirUdaje')->get($id);
        if (!$udaj) {
        $this->error('Údaje neboli nájdené');
        $this['RevirEditujForm']->setDefaults($udaj->toArray);
    }
    }

                protected function createComponentRevirEditujForm() {
        $form = (new \App\Forms\RevirEditujFormFactory())->create();
        
        return $form;
        
        
        
        
        }
    
}