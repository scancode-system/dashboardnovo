<?php

namespace Modules\Dashboard\Services\ViewComposer;

interface InterfaceComposer {

	public function data($view);
	public function assign($view);
	public function view($view);

}
