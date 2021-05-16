<?php

namespace Modules\Dashboard\Exports;

use Illuminate\Support\Collection;
use Modules\Dashboard\Entities\Item;
use Modules\ProductStock\Entities\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Order\Repositories\ItemRepository;
use Modules\ProductStock\Entities\ItemProductStock;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class ItemsFullExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data()
    {
        return array_merge($this->header(), $this->body());
    }

    private function header()
    {
        return [
            collect([
                'Código',
                'Concluido',
                'Referência',
                'Produto',
                'Preço',
                'Quantidade',
                'Total Bruto',
                'Desconto Valor',
                'Acrescimo Valor',
                'Total'
            ])->merge($this->headerStock())->merge([
                'Pagamento',
                'Comprador',
                'Email',
                'Telefone',
                'Representante'
            ])
        ];
    }


    private function headerStock()
    {
        $headerStock = collect([]);
        $headerStock = $headerStock->merge([
            'Quantidade - Atual',
            'Total -  Atual',
            'Data -  Atual',
        ]);
        $headerStock = $headerStock->merge([
            'Quantidade - Futuro',
            'Total -  Futuro',
            'Data -  Futuro',
        ]);
        return $headerStock;
    }


    private function body()
    {
        $items = Item::loadItemsClosedOrders();
        $body = [];

        foreach ($items as $item) {
            $order = $item->order;

            $row = collect([
                $this->codigo($order),
                $this->concluido($order),

                $this->referencia($item),
                $this->produto($item),
                $this->preco($item),

                $this->quantidade($item),
                $this->total_bruto($item),
                $this->desconto_valor($item),
                $this->acrescimo_Valor($item),
                $this->total($item)
            ])->merge($this->bodyStock($item))->merge([
                $this->pagamento($order),
                $this->comprador($order),
                $this->email($order),
                $this->telefone($order),
                $this->representante($order)
            ]);

            array_push($body, $row->toArray());
        }

        return $body;
    }

    private function bodyStock($item)
    {
        $item_stock = $item->item_stock;

        $bodyStock = collect([]);

        $bodyStock = $bodyStock->merge([
            $item_stock->qty_now,
            $item->total_now,
            $item->product->product_stock->date_now
        ]);

        $bodyStock = $bodyStock->merge([
            $item_stock->qty_future,
            $item->total_future,
            $item->product->product_stock->date_now
        ]);


        return $bodyStock;
    }

    private function codigo($order)
    {
        return $order->id;
    }

    private function concluido($order)
    {
        return $order->closing_date;
    }

    private function referencia($item)
    {
        return $item->product->sku;
    }

    private function produto($item)
    {
        return $item->product->description;
    }

    private function preco($item)
    {
        return $item->price;
    }

    private function quantidade($item)
    {
        return $item->qty;
    }

    private function total_bruto($item)
    {
        return $item->total_gross;
    }

    private function desconto_valor($item)
    {
        return $item->discount_value;
    }

    private function acrescimo_valor($item)
    {
        return $item->addition_value;
    }

    private function total($item)
    {
        return $item->total;
    }

    /*private function quantidade_atual($item)
    {
        return $item->item_product_stock_now_after->qty_now;
    }

    private function total_atual($item)
    {
        return $item->total_now;
    }

    private function data_atual($item)
    {
        return $item->item_product_stock_now_after->date_delivery_now;
    }

    private function quantidade_futura($item)
    {
        return $item->item_product_stock_now_after->qty_after;
    }

    private function total_futura($item)
    {
        return $item->total_after;
    }

    private function data_futura($item)
    {
        return $item->item_product_stock_now_after->date_delivery_after;
    }*/

    private function pagamento($order)
    {
        return $order->order_payment->description;
    }


    private function comprador($order)
    {
        return $order->order_client->buyer;
    }

    private function email($order)
    {
        return $order->order_client->email;
    }

    private function telefone($order)
    {
        return $order->order_client->phone;
    }

    private function representante($order)
    {
        return $order->saller->name;
    }
}
