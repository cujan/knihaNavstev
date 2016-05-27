<?php

namespace App\Presenters;

use Nette;
use App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
  
    
	
    

    /**
     * Check authorization
     * @return void
     */
    
    public function checkRequirements($element)
    {
	
        if ($element instanceof Nette\Reflection\Method) {
            /**
             * Check permissions for Action/handle methods
             *
             *  - Do not that (rely on presenter authorization)
             */
            return;
        } else {
            /**
             * Check permissions for presenter access
             */
            $resource = $element->getAnnotation('resource'); // 1*
        }

        if (!$this->user->isAllowed($resource)) { // 2*
            if (!$this->user->isLoggedIn()) {
                $this->redirect('Sign:in');
            } else {
                throw new Nette\Application\ForbiddenRequestException;
            }
        }
	$this->template->identity = $this->user->getIdentity();
	
    }
  
} 
    
   
    
 
    

