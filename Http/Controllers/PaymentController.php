<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Http\Requests\Payment\PaymentRequest;
use Modules\Dashboard\Entities\Payment;

class PaymentController extends Controller
{

    public function index(Request $request){
        return view('dashboard::payments.index');
    }


    public function create()
    {
        return view('dashboard::payments.create');
    }

    public function edit(Request $request, Payment $payment)
    {
        return view('dashboard::payments.edit');
    }

    public function store(PaymentRequest $request){
        Payment::create($request->all());
        return redirect()->route('payments.index')->with('success', 'Pagamento cadastrado.');
    }


    public function update(PaymentRequest $request, Payment $payment){
        $payment->update($request->all());
        return redirect()->route('payments.edit', $payment->id)->with('success', 'Pagamento atualizado.');
    }


    public function destroy(Request $request, Payment $payment){
        $payment->delete();
        return back()->with('success', 'Pagamento deletado.');
    }

}

