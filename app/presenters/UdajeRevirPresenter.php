<?php

namespace App\Presenters;


use App\Model;
use Nette\Application\UI\Form;
use Nette,  
    Nette\Utils\Html;


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
        public function renderEdit() {
            
        }
    
    public function actionEdit($id){
        $udaj = $this->database->table('revirUdaje')->fetchAll($id);
        
        dump($udaj);
        if (!$udaj) {
        $this->error('Údaje neboli nájdené');
        $this['revirEditujForm']->setDefaults($udaj);
        
       
        
    }
    }

      protected function createComponentRevirEditujForm() {
        $form = (new \App\Forms\RevirEditujFormFactory())->create();
        
        return $form;
        
        
        
        
        }
    
}