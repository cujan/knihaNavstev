<?php

namespace App\Presenters;

use Nette;
use App\Model;


class UdajeRevirPresenter extends BasePresenter {
    
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    
    
    public function renderDefault()
	{
		$this->template->post = $this->database->table('revirUdaje');
                $revirUdaje = $this->database->table('revirUdaje');
                dump($revirUdaje);
	}
    
}