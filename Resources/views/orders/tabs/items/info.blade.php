<div class="row mt-3">
	<div class="col border-rigt text-left py-0"><h5>Quantidade Mínima</h5></div>
	<div class="col text-left py-0"><h5>{{ $product->min_qty }} Unidades</h5></div>
</div>
<div class="row mt-2">
	<div class="col border-rigt text-left py-0"><h5>Multiplo</h5></div>
	<div class="col text-left py-0"><h5>{{ $product->multiple }}</h5></div>
</div>
<hr>
<div class="row mt-3">
	<div class="col border-rigt text-left py-0"><h5>Estoque Atual</h5></div>
	<div class="col text-left py-0"><h5>{{ $product->product_stock->qty_now ?? 'Infinita' }} Unidades</h5></div>
</div>
<div class="row mt-2">
	<div class="col border-rigt text-left py-0"><h5>Estoque Futuro</h5></div>
	<div class="col text-left py-0"><h5>{{ $product->product_stock->qty_future ?? 'Infinita' }} Unidades</h5></div>
</div>
{{ Form::hidden('price', $product->price) }}
{{ Form::hidden('ipi', $product->ipi) }}