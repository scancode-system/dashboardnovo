<?php

namespace Modules\Dashboard\Imports;


use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Support\Facades\Storage;

use Modules\Client\Repositories\ClientRepository;
use Modules\Client\Events\BeforeImportEvent;
use Modules\Client\Events\AfterImportEvent;
use Modules\Client\Repositories\ShippingCompanyRepository;
use Modules\Dashboard\Entities\Client;
use Modules\Dashboard\Services\Import\SessionService;

use Exception;
use Modules\Dashboard\Entities\PriceTable;
use Modules\Dashboard\Entities\Shipping;

class ClientsImport implements OnEachRow, WithHeadingRow, WithEvents
{

	use Importable, RegistersEventListeners;

	private $total_rows;

	public function onRow(Row $row)
	{
		try {
			$data = $this->parse($row->toArray());
			$client = Client::loadByUniqueKeys($data['id']);
			if ($client) {
				$client->update($data);
				SessionService::updated('ClientsImport', true, 'Cliente ' . $client->id . ' atualizado: ' . json_encode($client->toJson()) . "\r\n");
			} else {
				$client = Client::create($data);
				SessionService::new('ClientsImport',  true);
			}
		} catch (Exception $e) {
			SessionService::failures('ClientsImport', true, $e->getMessage() . "\r\n");
		}
		SessionService::completed('ClientsImport', ($row->getRowIndex() / $this->total_rows) * 100);
	}

	private function parse($data)
	{
		$data['shipping_id'] = $this->resolveShippingId($data);
		$data['price_table_id'] = $this->resolvePriceTableId($data);

		return $data;
	}

	private function resolveShippingId($data)
	{
		$shipping = Shipping::find($data['shipping_id']);

		if ($shipping) {
			return $data['shipping_id'];
		} elseif ($data['shipping_name']) {
			$shipping = Shipping::loadByName($data['shipping_name']);
			if ($shipping) {
				return $shipping->id;
			} else {
				$shipping = Shipping::create(['name' => $data['shipping_name']]);
				return $shipping->id;
			}
		}
	}

	private function resolvePriceTableId($data)
	{
		$price_table = PriceTable::loadByName($data['price_table_name']);
		if (!$price_table && !is_null($data['price_table_name'])) {
			$price_table = PriceTable::create(['name' => $data['price_table_name']]);
		}
		if ($price_table) {
			return $price_table->id;
		}
	}


	public static function beforeImport(BeforeImport $event)
	{
		SessionService::title('Client', 'import', 'Clientes');
		$cells = $event->getDelegate()->getActiveSheet()->toArray();
		$import = $event->getConcernable();
		$import->data($cells);
	}

	public function data($cells)
	{
		$this->total_rows = count($cells);
	}
}
/*


<?php

namespace Modules\Client\Imports;


use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Support\Facades\Storage;

use Modules\Client\Repositories\ClientRepository;
use Modules\Client\Events\BeforeImportEvent;
use Modules\Client\Events\AfterImportEvent;
use Modules\Client\Repositories\ShippingCompanyRepository;
use Modules\Client\Entities\Client;
use Modules\DashboardPortal\Services\SessionService;

use Exception;

class ClientsImport implements OnEachRow, WithHeadingRow, WithEvents
{

	use Importable, RegistersEventListeners;

	private $total_rows;

	public function onRow(Row $row)
	{
		try  
		{
			$client_data = $this->parse($row->toArray());

			$client_data = $this->beforeSave($client_data);
			$client = ClientRepository::clientByUniqueKeys($client_data['id'], $client_data['corporate_name'], $client_data['cpf_cnpj']);
			if($client){
				ClientRepository::update($client, $client_data);
				SessionService::updated('Client@import', 1);
			} else {
				$client = ClientRepository::store($client_data);
				SessionService::new('Client@import', 1);
			}
			$this->afterSave($client, $client_data);
		} catch(Exception $e) {
			SessionService::failures('Client@import', 1); 
			$previus_content = '';
			if(Storage::exists('failures/Client@import'))
			{
				$previus_content = Storage::get('failures/Client@import');
			}
			Storage::put('failures/Client@import', $previus_content.$e->getMessage()."\r\n");
		}
		SessionService::completed('Client@import', ($row->getRowIndex()/$this->total_rows)*100); 
	}

	private function parse($client_data)
	{
		$client_data['client_address'] = [
			'street' => $client_data['street'],
			'number' => $client_data['number'],
			'apartment' => $client_data['apartment'],
			'neighborhood' => $client_data['neighborhood'],
			'city' => $client_data['city'],
			'st' => $client_data['st'],
			'postcode' => $client_data['postcode'],
		];
		return $client_data;	
	}

	private function beforeSave($data)
	{
		$data = collect($data);
		$results = event(new BeforeImportEvent($data));

		foreach ($results as $result) {
			$data = $data->merge($result);
		}
		return $data->toArray();
	}

	private function afterSave(Client $client, $data)
	{
		event(new AfterImportEvent($client, $data));
	}

	public static function beforeImport(BeforeImport $event)
	{
		$cells = $event->getDelegate()->getActiveSheet()->toArray();
		$import = $event->getConcernable();
		$import->data($cells);
	}

	public function data($cells)
	{
		$this->total_rows = count($cells);
	}
}
*/