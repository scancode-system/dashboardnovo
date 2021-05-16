<div class="row mb-3">
    <div class="col">
        {{ Form::open(['route' => 'orders.index']) }}
        <div class="input-group">
            <span class="input-group-prepend">
                {{ Form::button('<i class="cil-search"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
            </span>
            {{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Pesquisar']) }}
        </div>
        {{ Form::close() }}
    </div>
    <div class="col text-right">
        <a href="#" class="btn btn-brand btn-primary" data-toggle="modal" data-target="#modal_create_order_items"><i class="fa fa-plus-square-o"></i><span>Novo Item</span></a>
    </div>
</div>
<table class="table table-responsive-sm bg-white table-hover border">
    <thead>
        <tr>
            <!--<th>Img.</th>-->
            <th>Referência</th>
            <th>Produto</th>
            <th class="text-center">Preço</th>
            <!--<th class="text-center">Desc</th>-->
            <th class="text-center">Quantidade</th>
            <th class="text-center">Total Bruto</th>
            <th class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td class="align-middle">{{ $item->product->sku }}</td>
            <td class="align-middle">{{ $item->product->description }}</td>
            <td class="align-middle text-center">@currency($item->price)</td>
            <td class="align-middle text-center">{{ $item->qty }} Unidades</td>
            <td class="align-middle text-center">@currency($item->total_gross)</td>
            <td class="text-right align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{ Form::button('<i class="cil-search"></i>', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#modal_view_items_'.$item->id]) }}
                    {{ Form::button('<i class="cil-pencil"></i>', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_edit_items_'.$item->id]) }}
                    {{ Form::button('<i class="cil-trash"></i>', ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modal_destroy_items_'.$item->id]) }}
                </div>
            </td>
            @include('dashboard::orders.tabs.items.modals.modal_view_items')
            @include('dashboard::orders.tabs.items.modals.modal_edit_items', ['modal_id' => 'modal_edit_items_'.$item->id, 'item' => $item])
            @modal_destroy(['route_destroy' => 'items.destroy', 'model' => $item->id, 'modal_id' => 'modal_destroy_items_'.$item->id])
        </tr>
        @endforeach
    </tbody>
</table>
{{ $items->links() }}
@include('dashboard::orders.tabs.items.modals.modal_create_items', ['modal_id' => 'modal_create_order_items', 'item' => null])


<div class="row">
    <div class="mb-3 mb-xl-0 col-md-6 col-xl-3">
        <div class="card mb-0">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="cil-money bg-primary p-4 font-2xl mr-3 text-white"></i>
                <div>
                    <div class="text-value-sm text-primary">@currency($order->total_gross)</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Total Bruto</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 mb-xl-0 col-md-6 col-xl-3">
        <div class="card mb-0">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="cil-tag bg-info p-4 font-2xl mr-3 text-white"></i>
                <div>
                    <div class="text-value-sm text-info">@currency($order->discount_value)</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Desconto</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 mb-md-0 col-md-6 col-xl-3">
        <div class="card mb-0">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="cil-graph text-white bg-secondary p-4 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-secondary">@currency($order->addition_value)</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Acrescimo</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 mb-md-0 col-md-6 col-xl-3">
        <div class="card mb-0">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="cil-graph text-white bg-dark p-4 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-secondary">@currency($order->tax_value)</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Impostos</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-12 mt-3">
        <div class="card mb-0">
            <div class="card-body p-0 d-flex align-items-center">
                <i class="cil-cash text-white bg-danger p-4 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-danger">@currency($order->total)</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Total</div>
                </div>
            </div>
        </div>
    </div>
</div>