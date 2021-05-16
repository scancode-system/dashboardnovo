<?php 
namespace Modules\Dashboard\Exports;

use Illuminate\Support\Collection;
use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Product;
use Modules\ProductStock\Entities\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Order\Repositories\ItemRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\ProductStock\Entities\ItemProductStock;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class ProductsFullExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data(){
        return array_merge($this->header(), $this->body());
    }


    private function header(){
        return [
            collect([
                'Referência', 
                'Descrição', 
                'Categoria', 
                'Preço'])->
            merge($this->headerStock())->
            merge([
                'Unidades Vendidas', 
                'Total Bruto', 
                'Total de Descontos', 
                'Total de Acréscimos', 
                'Total Final'])
        ];
    }

    private function headerStock(){
        $headerStock = collect([]);
        //foreach (Stock::orderBy('priority')->get() as $stock) {
            $headerStock = $headerStock->merge([
                //'Atual - Unidades Disponibilizada', 
                'Unidades Vendidas - Atual', 
                'Unidades Restantes - Atual', 
                'Data Entrega - Atual', 
                'Total Bruto - Atual', 
                'Total de Descontos - Atual', 
                'Total de Acréscimos - Atual', 
                'Total Final - Atual'
            ]);

            $headerStock = $headerStock->merge([
               // 'Futuro - Unidades Disponibilizada', 
                'Unidades Vendidas - Futuro', 
                'Unidades Restantes - Futuro', 
                'Data Entrega - Futuro', 
                'Total Bruto - Futuro', 
                'Total de Descontos - Futuro', 
                'Total de Acréscimos - Futuro', 
                'Total Final - Futuro'
            ]);
        //}
        return $headerStock;
    }


    private function body(){
        $products = Product::all();
        $body = [];

        foreach ($products as $product) {
            $row = collect(['
                referencia' => $product->sku,
                'descricao' => $product->description,
                'categoria' => $product->category,
                'preco' => $product->price])->
            merge($this->bodyStock($product))->
            merge([
                'quantidade' => 0,
                'total_bruto' => 0,
                'desconto_valor' => 0,
                'acrescimo_valor' => 0,
                'total' => 0])->
            toArray();

            $row = (object) $row;

            $items = Item::loadItemsByProductWithClosedOrders($product);

            foreach ($items as $item) {
                $item_stock = $item->item_stock; 
                //foreach (Stock::orderBy('priority')->get() as $stock) {
                    $row->qty_sold_atual += $item_stock->qty_now;
                    $row->total_gross_atual += round($item->total_gross_now, 2);
                    $row->total_discount_value_atual += round($item->total_discount_now_value, 2);
                    $row->total_addition_value_atual += round($item->total_addition_value_now, 2);
                    $row->total_atual += round($item->total_now, 2);

                    $row->qty_sold_futuro += $item_stock->qty_future;
                    $row->total_gross_futuro += round($item->total_gross_future, 2);
                    $row->total_discount_value_futuro += round($item->total_discount_future_value, 2);
                    $row->total_addition_value_futuro += round($item->total_addition_value_future, 2);
                    $row->total_futuro += round($item->total_future, 2);
                //}

                $row->quantidade += $item->qty;
                $row->total_bruto += round($item->total_gross, 2);
                $row->desconto_valor += round($item->total_discount_value, 2);
                $row->acrescimo_valor += round($item->total_addition_value, 2);
                $row->total += round($item->total, 2);
            }

            array_push($body, $row);
        }

        return (new Collection($body))->sortByDesc('total')->toArray();

    }

    public function bodyStock($product){
        $bodyStock = collect([]);
        //foreach (Stock::orderBy('priority')->get() as $stock) {
            $bodyStock = $bodyStock->merge([
                //$product->product_stock->{$stock->available_field}, // este por ultimo
                'qty_sold_atual' => 0,
                $product->product_stock->qty_now,  // este por ultimo
                $product->product_stock->date_now,  // este por ultimo
                'total_gross_atual' => 0,
                'total_discount_value_atual' => 0, 
                'total_addition_value_atual' => 0, 
                'total_atual' => 0, 
            ]);

            $bodyStock = $bodyStock->merge([
                //$product->product_stock->{$stock->available_field}, // este por ultimo
                'qty_sold_futuro' => 0,
                $product->product_stock->qty_future,  // este por ultimo
                $product->product_stock->date_future,  // este por ultimo
                'total_gross_futuro' => 0,
                'total_discount_value_futuro' => 0, 
                'total_addition_value_futuro' => 0, 
                'total_futuro' => 0, 
            ]);
        //}
        return $bodyStock;
    }

}