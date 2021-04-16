<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{

    public function index()
    {
        return view('dashboard::orders.index');
    }

}
