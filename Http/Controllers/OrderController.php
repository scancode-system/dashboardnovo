<?php

namespace Modules\Dashboard\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Order;
use Illuminate\Contracts\Support\Renderable;
use Modules\Dashboard\Http\Requests\Order\OrderRequest;

class OrderController extends Controller
{

    public function index()
    {
        return view('dashboard::orders.index');
    }

    public function edit(Request $request, Order $order, $tab = 0)
    {
        return view('dashboard::orders.edit');
    }
    

    public function store(OrderRequest $request){
        $order = Order::create($request->all());
        return redirect()->route('orders.edit', $order)->with('success', 'Pedido de código #'.$order->id.' cadastrado.');
    }

    public function update(OrderRequest $request, Order $order){
        //try{
            $order->update($request->all());
            return back()->with('success', 'Pedido atualizado.');
        //} catch (Exception $e){
            return back()->withErrors($e->getMessage());
        //}  
    } 
    
    public function destroy(Request $request, Order $order){
        foreach ($order->items as $item) {
            $item->delete();
        }
        $order->delete();
        return back()->with('success', 'Pedido deletado.');
    }

    public function clone(Request $request, Order $order){
        try{
            $new_order = $order->clone();
            return redirect()->route('orders.edit', $new_order)->with('success', 'Pedido '.$new_order->id.' criado como clone do pedido '.$order->id.'.');
        } catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }     
    }

}
