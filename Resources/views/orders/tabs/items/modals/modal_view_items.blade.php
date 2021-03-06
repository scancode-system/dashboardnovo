<x-modal_view :modal-id="'modal_view_items_'.$item->id">

@slot('title')
Pedido #{{ $item->order->id }}
@endslot
<div class="d-flex justify-content-center mb-3">
	<img src="{{ url($item->product->image) }}" alt="..." class="img-thumbnail w-50" style="width: 223px; height: 180px">
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Referencia: </strong></div>
	<div class="col">{{ $item->product->sku }}</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Descricao: </strong></div>
	<div class="col">{{ $item->product->description }}</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Desconto Máximo: </strong></div>
	<div class="col text-danger"><strong>@percentage($item->product->discount_limit)</strong></div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Preço Bruto: </strong></div>
	<div class="col">@currency($item->price)</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Desconto: </strong></div>
	<div class="col">@percentage($item->discount) - @currency($item->discount_value)</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Acréscimo: </strong></div>
	<div class="col">@percentage($item->addition) - @currency($item->addition_value)</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col text-capitalize"><strong>IPI: </strong></div>
	<div class="col">@percentage($item->ipi) - @currency($item->ipi_value)</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Preço Líquido: </strong></div>
	<div class="col">@currency($item->price_net)</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Quantidade: </strong></div>
	<div class="col">{{ $item->qty }}</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Total: </strong></div>
	<div class="col">@currency($item->total)</div>
</div>
<hr>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Quantidade Atual: </strong></div>
	<div class="col">{{ $item->item_stock->qty_now }}</div>
</div>
<div class="row justify-content-center mb-2">
	<div class="col"><strong>Quantidade Futura: </strong></div>
	<div class="col">{{ $item->item_stock->qty_future }}</div>
</div>
</x-modal_view>