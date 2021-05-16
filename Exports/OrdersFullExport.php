<?php 
namespace Modules\Dashboard\Exports;

use Illuminate\Support\Collection;
use Modules\Dashboard\Entities\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class OrdersFullExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data(){
        return array_merge($this->header(), $this->body());
    }

    private function header(){
        return [['codigo', 'concluido', 'total_bruto', 'desconto', 'acrescimo', 'total', 'quantidade_items', 'observacao', 'cod_pagamento', 'pagmento', 'cod_cliente', 'comprador', 'email_cliente', 'telefone', 'razao_social', 'nome_fantasia', 'cpf_cnpj', 'rua', 'numero', 'bairo', 'cidade', 'estado', 'cep',  'cod_representante', 'representante', 'email_representante', 'cod_transportadora', 'transportadora']];
    }


    private function body(){
        $orders = Order::loadClosedOrders();
        $body = [];

        foreach ($orders as $order) {
            array_push($body, [
                $this->codigo($order),
                $this->concluido($order),
                $this->total_bruto($order),
                $this->desconto($order),
                $this->acrescimo($order),
                $this->total($order),
                $this->quantidade_items($order),
                $this->observacao($order),
                $this->cod_pagamento($order),
                $this->pagamento($order),
                $this->cod_cliente($order),
                $this->comprador($order),
                $this->email_cliente($order),
                $this->telefone($order),
                $this->razao_social($order),
                $this->nome_fantasia($order),
                $this->cpf_cnpj($order),
                $this->rua($order),
                $this->numero($order),
                $this->bairro($order),
                $this->cidade($order),
                $this->estado($order),
                $this->cep($order),
                $this->cod_representante($order),
                $this->representante($order),
                $this->email_representante($order),
                $this->cod_transportadora($order),
                $this->transportadora($order),
            ]);
        }

        return (new Collection($body))->sortByDesc('total')->toArray();
    }

    private function codigo($order){
        return $order->id;
    }

    private function concluido($order){
        return $order->closing_date;
    }

    private function total_bruto($order){
        return $order->total_gross;
    }

    private function desconto($order){
        return $order->discount_value;
    }

    private function acrescimo($order){
        return $order->addition_value;
    }

    private function total($order){
        return $order->total;
    }

    private function quantidade_items($order){
        return $order->total_items;
    }

    private function observacao($order){
        return $order->observation;
    }

    private function cod_pagamento($order){
        return $order->payment_id;
    }

    private function pagamento($order){
        return $order->order_payment->description;
    }

    private function cod_cliente($order){
        return $order->client_id;
    }

    private function comprador($order){
        return $order->order_client->buyer;
    }

    private function email_cliente($order){
        return $order->order_client->email;
    }

    private function telefone($order){
        return $order->order_client->phone;
    }

    private function razao_social($order){
        return $order->client->corporate_name;
    }

    private function nome_fantasia($order){
        return $order->client->fantasy_name;
    }

    private function cpf_cnpj($order){
        return $order->client->cpf_cnpj;
    }

    private function rua($order){
        return $order->client->street;
    }

    private function numero($order){
        return $order->client->number;
    }

    private function bairro($order){
        return $order->client->neighborhood;
    }

    private function cidade($order){
        return $order->client->city;
    }

    private function estado($order){
        return $order->client->st;
    }

    private function cep($order){
        return $order->client->postcode;
    }

    private function cod_representante($order){
        return $order->saller_id;
    }

    private function representante($order){
        return $order->saller->name;
    }

    private function email_representante($order){
        return $order->saller->email;
    }


    private function cod_transportadora($order){
        return $order->order_client->shipping_id;
    }

    private function transportadora($order){
        return $order->order_client->shipping;
    }

}