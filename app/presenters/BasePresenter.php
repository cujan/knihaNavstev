<?php

namespace App\Presenters;

use Nette;
use App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
  
    

    public function actionDefault()
    {
        if (!$this->getUser()->isLoggedIn()) {
        $this->redirect('Sign:in');
        }
    
        
    }
    
    
    
   
    
 
    
}
