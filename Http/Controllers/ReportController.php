<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Dashboard\Entities\Report;
use Illuminate\Contracts\Support\Renderable;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard::reports.index');
    }

    public function download(Request $request, Report $report)
    {
        return Excel::download(new $report->export_class, $report->file_alias);
    }
}
