<?php

namespace Modules\Dashboard\Imports;

use Exception;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Support\Facades\Storage;

use Modules\Saller\Repositories\SallerRepository;
use Modules\Dashboard\Entities\Saller;
use Modules\Dashboard\Services\Import\SessionService;

class SallersImport implements OnEachRow, WithHeadingRow, WithEvents
{

	use Importable, RegistersEventListeners;

	public $total_rows;

	public function onRow(Row $row)
	{
		$data = $row->toArray();
		try {
			$saller = Saller::loadByUniqueKeys($data['id'], $data['login'], $data['email']);
			if ($saller) {
				$saller->update($data);
				SessionService::updated('SallersImport', 'import', true, 'Representante ' . $saller->id . ' atualizado: ' . json_encode($saller->toJson()) . "\r\n");
			} else {
				$saller = Saller::create($data);
				SessionService::new('SallersImport', true);
			}
		} catch (Exception $e) {
			SessionService::failures('SallersImport', true, $e->getMessage() . "\r\n");
		}
		SessionService::completed('SallersImport', ($row->getRowIndex() / $this->total_rows) * 100);
	}

	private function parse($data)
	{
		return $data;
	}

	public static function beforeImport(BeforeImport $event)
	{
		SessionService::title('SallersImport', 'Representantes');
		$cells = $event->getDelegate()->getActiveSheet()->toArray();
		$import = $event->getConcernable();
		$import->total_rows = count($cells); 
	}

}
