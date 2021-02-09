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

use Modules\Dashboard\Entities\Payment;
use Modules\Dashboard\Services\Import\SessionService;


class PaymentsImport implements OnEachRow, WithHeadingRow, WithEvents
{

	use Importable, RegistersEventListeners;

	public $total_rows;

	public function onRow(Row $row)
	{
		try  
		{
			$data = $row->toArray();

			$payment = Payment::loadByUniqueKeys($data['id'], $data['description']);
			if($payment){
				$payment->update($data);
				SessionService::updated('PaymentsImport', true, 'Pagamento '.$payment->id.' atualizado: '. json_encode($payment->toJson())."\r\n");
			} else {
				$payment = Payment::create($data);
				SessionService::new('PaymentsImport', true);
			}
		} catch(Exception $e) {
			SessionService::failures('PaymentsImport', true, $e->getMessage()."\r\n");
		}
		SessionService::completed('PaymentsImport', ($row->getRowIndex()/$this->total_rows)*100); 
	}


	public static function beforeImport(BeforeImport $event)
	{
		SessionService::title('SallersImport', 'Representantes');
		$cells = $event->getDelegate()->getActiveSheet()->toArray();
		$import = $event->getConcernable();
		$import->total_rows = count($cells);
	}

}
