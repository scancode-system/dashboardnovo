<?php 
namespace Modules\Dashboard\Exports;

use Illuminate\Support\Collection;
use Modules\Dashboard\Entities\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemsExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data(){
    	return array_merge($this->header(), $this->body());
    }

    private function header(){
    	return [['codigo', 'concluido', 'referencia', 'produto', 'preco', 'quantidade', 'total_bruto', 'desconto_valor', 'acrescimo_Valor', 'total', 'pagamento', 'comprador', 'email', 'telefone', 'representante']];
    }


    private function body(){
    	$items = Item::loadItemsClosedOrders();
    	$body = [];

    	foreach ($items as $item) {
            $order = $item->order;

    		array_push($body, [
    			$this->codigo($order),
                $this->concluido($order),

                $this->referencia($item),
                $this->produto($item),
                $this->preco($item),
                $this->quantidade($item),
                $this->total_bruto($item),
                $this->desconto_valor($item),
                $this->acrescimo_Valor($item),
                $this->total($item),

                $this->pagamento($order),
                $this->comprador($order),
                $this->email($order),
                $this->telefone($order),
                $this->representante($order),
            ]);
    	}

    	return $body;
    }

    private function codigo($order){
    	return $order->id;
    }

    private function concluido($order){
        return $order->closing_date;
    }

    private function referencia($item){
        return $item->product->sku;
    }

    private function produto($item){
        return $item->product->description;
    }

    private function preco($item){
        return $item->price;
    }

    private function quantidade($item){
        return $item->qty;
    }

    private function total_bruto($item){
    	return $item->total_gross;
    }

    private function desconto_valor($item){
        return $item->discount_value;
    }

    private function acrescimo_valor($item){
        return $item->addittion_value;
    }

    private function total($item){
        return $item->total;
    }

    private function pagamento($order){
        return $order->order_payment->description;
    }


    private function comprador($order){
    	return $order->order_client->buyer;
    }

    private function email($order){
    	return $order->order_client->email;
    }

    private function telefone($order){
    	return $order->order_client->phone;
    }

    private function representante($order){
    	return $order->saller->name;
    }

}