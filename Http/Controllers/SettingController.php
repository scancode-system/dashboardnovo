<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\PdfLayout;
use Modules\Dashboard\Entities\SettingPdf;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Entities\SettingOrder;
use Modules\Dashboard\Entities\SettingClient;
use Modules\Dashboard\Entities\SettingPdfColumn;

class SettingController extends Controller
{

    public function index()
    {
        return view('dashboard::settings.index');
    }

    public function updateClient(Request $request){
        (SettingClient::get())->update($request->all());
        return back()->with('success', 'Configuração atualizada.');
    }

    public function updateOrder(Request $request){
        (SettingOrder::get())->update($request->all());
        return back()->with('success', 'Configuração atualizada.');
    }

    public function updatePdf(Request $request){
        (SettingPdf::get())->update($request->all());
        return back()->with('success', 'Configuração atualizada.');
    }

    public function updatePdfLayouts(Request $request, PdfLayout $pdf_layout)
    {
        PdfLayout::select($pdf_layout);
        return back()->with('success', 'Layout "<strong>'.$pdf_layout->title.'</strong>"" selecionado.');
    }


    public function updatePdfColumns(Request $request)
    {
        foreach ($request->setting_pdf_columns as $id => $show) {
            SettingPdfColumn::updateById($id, ['show' => $show]);
        }
        return back()->with('success', 'Configuração do PDF atualizado.');
    }


}
