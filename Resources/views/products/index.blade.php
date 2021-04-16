@extends('dashboard::layouts.master')

@section('content')

<div class="card">
	@search_add(['route_search' => 'products.index', 'route_add' => 'products.create'])
	<div class="card-body">
		<table class="table table-responsive-sm bg-white table-hover border">
			<thead>
				<tr>
					<th>Img</th>
					<th>Referência</th>
					<th>Descrição</th>
					<th>Preço</th>
					<th>Categoria</th>
					<th class="text-right">Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>
						<img src="{{ url($product->image) }}" alt="..." class="img-thumbnail" style="height: 75px;">
					</td>
					<td class="align-middle">{{ $product->sku }}</td>
					<td class="align-middle">{{ $product->description }}</td>
					<td class="align-middle">
						@currency($product->price)
					</td>
					<td class="align-middle">{{ $product->product_category->description }}</td>
					<td class="text-right align-middle">
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#products_view_{{ $product->id }}"><i class="cil-search"></i></button>
							<a href="{{ route('products.edit', $product) }}" class="btn btn-primary"><i class="cil-pencil"></i></a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#products_destroy_{{ $product->id }}"><i class="cil-trash"></i></button>
						</div>
					</td>
					@include('dashboard::products.modals.view_products')
					@modal_destroy(['route_destroy' => 'products.destroy', 'model' => $product, 'modal_id' => 'products_destroy_'.$product->id])
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $products->links() }}
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Produtos
</li>
@endsection