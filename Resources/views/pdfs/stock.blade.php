@extends('dashboard::pdfs.layouts.master')

@section('content')
<table class="w-100 mb-3">
	<thead>
		<tr>
			<th colspan="{{ 7+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Items do Estoque: Atual</th>
		</tr>
		<tr>
			@if($setting_pdf_image->show)
			<th class="border-bottom border-top border-dark border-left p-2">Img</th>
			@endif
			<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
			<th class="border-bottom border-top border-dark p-2">Descrição</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Prç Bru</th>
			@if($setting_pdf_discount->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
			@endif
			@if($setting_pdf_addition->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
			@endif
			@if($setting_pdf_ipi->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
			@endif
			<th class="border-bottom border-top border-dark p-2 text-center">Prç Liq</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
			<th class="border-bottom border-top border-dark border-right p-2 text-center">Total</th>
		</tr>
	</thead>
	<tbody>
		@foreach($order->items_now as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->product->sku }}</td>
			<td class="border-bottom border-dark p-2">
				{{ $item->product->description }}
				<small class="text-info">{{ $item->observation }}</small>
			</td>
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->discount_value)<br>
				<small>(@percentage($item->discount))</small>
			</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->addition_value)<br>
				<small>(@percentage($item->addition))</small>
			</td>
			@endif
			@if($setting_pdf_ipi->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->ipi_value) - @percentage($item->ipi)
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">@currency($item->price_net)</td>
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_stock->qty_now }}</td>
			<td class="border-bottom border-right border-dark text-center p-2">@currency($item->total_now)
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<table class="w-100 mb-3">
	<thead>
		<tr>
			<th colspan="{{ 7+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Items do Estoque: Futuro</th>
		</tr>
		<tr>
			@if($setting_pdf_image->show)
			<th class="border-bottom border-top border-dark border-left p-2">Img</th>
			@endif
			<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
			<th class="border-bottom border-top border-dark p-2">Descrição</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Prç Bru</th>
			@if($setting_pdf_discount->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
			@endif
			@if($setting_pdf_addition->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
			@endif
			@if($setting_pdf_ipi->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
			@endif
			<th class="border-bottom border-top border-dark p-2 text-center">Prç Liq</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
			<th class="border-bottom border-top border-dark border-right p-2 text-center">Total</th>
		</tr>
	</thead>
	<tbody>
		@foreach($order->items_now as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->product->sku }}</td>
			<td class="border-bottom border-dark p-2">
				{{ $item->product->description }}
				<small class="text-info">{{ $item->observation }}</small>
			</td>
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->discount_value)<br>
				<small>(@percentage($item->discount))</small>
			</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->addition_value)<br>
				<small>(@percentage($item->addition))</small>
			</td>
			@endif
			@if($setting_pdf_ipi->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->ipi_value) - @percentage($item->ipi)
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">@currency($item->price_net)</td>
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_stock->qty_future }}</td>
			<td class="border-bottom border-right border-dark text-center p-2">@currency($item->total_future)
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection