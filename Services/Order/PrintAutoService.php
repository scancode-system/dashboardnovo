<?php

namespace Modules\Dashboard\Services\Order;

use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Jobs\PrintAutoJob;
use Modules\Dashboard\Entities\SettingOrder;
use Modules\Dashboard\Services\Pdf\PDFService;

class PrintAutoService
{

	public function __invoke(Order $order)
	{
		if((SettingOrder::get())->auto && !$order->getOriginal('print_auto')){
			$pdf_service = new PDFService($order);
			$pdf_service->makePdf();
			PrintAutoJob::dispatch($pdf_service->path());
		}
	}


}
