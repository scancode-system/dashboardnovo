<?php

namespace Modules\Dashboard\Services\Import;

use Modules\Dashboard\Imports\SallersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportService {

	private $class;
	private $path;

	function __construct($import_class, $path) {
		$import_class = 'Modules\Dashboard\Imports\\'.$import_class;

		$this->class = new $import_class;
		$this->path = $path;
	}

	public function import()
	{
		if(Storage::exists($this->path)){
			Excel::import($this->class, $this->path);
		}
	}

}