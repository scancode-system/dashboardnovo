<?php 

namespace Modules\Dashboard\Services\Pdf;


use Modules\Dashboard\Entities\Order;

use Illuminate\Support\Facades\Storage;
use Modules\Dashboard\Entities\Company;
use Modules\Dashboard\Entities\PdfLayout;
use Modules\Dashboard\Entities\SettingPdf;

use Modules\Dashboard\Entities\SettingOrder;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Modules\Dashboard\Entities\SettingPdfColumn;


class PDFService {

	private $order;
	private $pdf;
	private $pdf_file;

	public function __construct(Order $order) {
		$this->order = $order;
		$this->setting_pdf = SettingPdf::get();
		$this->setting_order = SettingOrder::get();
	}


	public function makePdf(){
		$this->pdf = PDF::loadView(PdfLayout::loadView(), 
			[
				'order' => $this->order, 
				'company' => Company::get(), 
				'setting_pdf' => $this->setting_pdf, 
				'count_show_columns' => SettingPdfColumn::countShowColumns(), 
				'setting_order' => $this->setting_order
			]+$this->setting_columns())->setOption('footer-center', 'Page [page]')->setOption('footer-font-size', 8);

		$this->pdf_file = $this->pdf->inline('pedido_'.$this->order->id.'.pdf');
		Storage::disk('public')->put('pedidos/pedido_'.$this->order->id.'.pdf', $this->pdf_file, 'public');
	}


	private function setting_columns()
	{
		$columns = [];
		$setting_pdf_columns = SettingPdfColumn::all();
		foreach ($setting_pdf_columns as $setting_pdf_column) {
			$columns['setting_pdf_'.$setting_pdf_column->name] = $setting_pdf_column;
		}
		return $columns;
	}

	public function download(){
		return $this->pdf_file;
	}

	public function path(){
		return public_path('/storage/pedidos/pedido_'.$this->order->id.'.pdf');
	}

}