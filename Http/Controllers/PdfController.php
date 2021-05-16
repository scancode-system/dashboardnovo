<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Services\Pdf\PDFService;

class PdfController extends Controller
{

    public function download(Request $request, Order $order){
		$order->load(['order_client', 'client', 'saller', 'order_payment', 'items']);	
		$pdf_service = new PDFService($order);
		$pdf_service->makePdf();
		return $pdf_service->download();
	}

}
