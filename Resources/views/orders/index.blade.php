@extends('dashboard::layouts.master')

@section('content')

<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col">
                {{ Form::open(['route' => 'orders.index', 'method' => 'GET']) }}
                <div class="input-group">
                    <span class="input-group-prepend">
                        {{ Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                    </span>
                    {{ Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'Pesquisar']) }}
                </div>
                {{ Form::close() }}
            </div>
            <div class="col text-right">
                <a href="#" class="btn btn-brand btn-primary" data-toggle="modal" data-target="#modal_create_order"><i class="fa fa-plus-square-o"></i><span>Novo Pedido</span></a>
                @include('order::modals.modal_create_order')
                <a href="#" class="btn btn-brand btn-danger ml-2" data-toggle="modal" data-target="#modal_clean_orders"><i class="fa fa-trash"></i><span>Limpar Pedidos</span></a>
                @include('order::modals.modal_clean_orders')
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm bg-white table-hover border">
            <thead>
                <tr>
                    <th>Cod.</th>
                    <th>Cliente</th>
                    <th>Comprador</th>
                    <th>Representante</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Fechamento</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($orders as $order)
                <tr>
                    <td class="align-middle">{{ '#'.$order->id }}</td>
                    <td class="align-middle">{{ $order->order_client->corporate_name ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $order->order_client->buyer ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $order->order_saller->name ?? 'N/A'}}</td>
                    <td class="align-middle text-center"><span class="badge badge-{{ $order->status->color }} badge-pill py-1 px-4">{{ $order->status->description }}</span></td>
                    <td class="align-middle text-center">@currency($order->total)</td>
                    <td class="align-middle text-center">{{ $order->closing_date ?? 'N/A' }}</td>

                    <td class="text-right align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#orders_show_{{ $order->id }}"><i class="fa fa-eye"></i></button>
                            <a href="{{ route('orders.edit', [$order->id, 0]) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#orders_destroy_{{ $order->id }}"><i class="fa fa-trash-o"></i></button>
                        </div>
                    </td>
                    @include('order::modals.modal_show_orders')
                    @modal_destroy(['route_destroy' => 'orders.destroy', 'model' => $order->id, 'modal_id' => 'orders_destroy_'.$order->id])
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
    Pedidos
</li>
@endsection