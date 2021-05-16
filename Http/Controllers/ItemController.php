<?php

namespace Modules\Dashboard\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Product;
use Modules\Dashboard\Http\Requests\Order\ItemRequest;

class ItemController extends Controller
{

    public function store(ItemRequest $request, Order $order){
        try{
            $item = Item::create($request->all());
            //event(new ItemControllerAfterStoreEvent($item, $request->all())); // desconto para ordesign
            return back()->with('success', 'Item cadastrado.');
        } catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }    



    public function editInfoAjax(Request $request, Product $product){
        return view('dashboard::orders.tabs.items.info');     
    }


    public function update(ItemRequest $request, Item $item){
        try{
            //event(new ItemControllerBeforeUpdateEvent($item, $request->all())); // desconto para ordesign
            $item->update($request->all());
            return back()->with('success', 'Item atualizado.');
        } catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }        
    }  


    public function destroy(Request $request, Item $item){
        try{
            $item->delete();
            return back()->with('success', 'Item deletado.');
        } catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

}
