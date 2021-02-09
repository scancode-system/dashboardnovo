<?php

namespace Modules\Dashboard\Services\ViewComposer;

use Modules\Dashboard\Services\ViewComposer\InterfaceComposer;
use Illuminate\View\View;
use \stdClass;

abstract class ServiceComposer  implements InterfaceComposer {

    protected $view;
	protected $data;

	public function __construct(){
		$this->data = new stdClass;
	}

    public function compose(View $view) {
        $this->view = $view;
        
        $this->data($view);
        $this->assign($view);
        $this->view($view);
    }

    public function data($view){}

}
