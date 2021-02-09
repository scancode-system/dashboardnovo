<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Services\Import\SessionService;
use Modules\Dashboard\Services\Import\ImportService;

class ImportController extends Controller
{


    public function index()
    {
        return view('dashboard::imports.index');
    }

    /**import entities */    
    public function saller()
    {
        return view('dashboard::imports.saller');
    }

    public function payment()
    {
        return view('dashboard::imports.payment');
    }

    /**import operations */
    public function upload(Request $request)
    {
        $path = $request->file->store('uploads');
        return response()->json(['path' => $path, 'import_class' => $request->import_class], 200);
    }

    public function start(Request $request)
    {
        SessionService::clear($request->import_class);
        $import_service = new ImportService($request->import_class, $request->path);
        $import_service->import();
    }

    public function update(Request $request)
    {
        return view('dashboard::imports.widget.index', ['import_class' => $request->import_class]);
    }

    public function report(Request $request, $file_name)
    {
        return response()->download(storage_path('app/failures/'.$file_name));
    }


}
