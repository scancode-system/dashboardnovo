<?php 
namespace Modules\Dashboard\Exports;

use Illuminate\Support\Collection;
use Modules\Dashboard\Entities\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProductsExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data(){
    	return array_merge($this->header(), $this->body());
    }

    private function header(){
    	return [['Referência', 'Descrição', 'Categoria', 'Preço', 'Unidades Vendidas', 'Total Bruto', 'Total de Descontos', 'Total de Acréscimos', 'Total Final']];
    }


    private function body(){
        $products = Product::all();
        $body = [];

        foreach ($products as $product) {
            $row = (object) [
                'referencia' => $product->sku,
                'descricao' => $product->description,
                'categoria' => $product->category,
                'preco' => $product->price,
                'quantidade' => 0,
                'total_bruto' => 0,
                'desconto_valor' => 0,
                'acrescimo_valor' => 0,
                'total' => 0,
            ];

            $items = $product->sold_items;

            foreach ($items as $item) {
                $row->quantidade += $item->qty;
                $row->total_bruto += $item->total_gross;
                $row->desconto_valor += $item->total_discount_value;
                $row->acrescimo_valor += $item->total_addition_value;
                $row->total += $item->total;
            }

            array_push($body, $row);
        }

        return (new Collection($body))->sortByDesc('total')->toArray();

    }


}