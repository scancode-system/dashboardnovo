@if(isset($product))
{{ Form::model($product, ['route' => ['products.update', $product], 'method' => 'put']) }}
{{ Form::hidden('id', $product->id) }}
@else
{{ Form::open(['route' => 'products.store']) }}
@endif
<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('sku', 'Referência') }}
			{{ Form::text('sku', old('sku'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('barcode', 'Código de Barras') }}
			{{ Form::text('barcode', old('barcode'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Descrição') }}
			{{ Form::text('description', old('description'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('price', 'Preço') }}
			{{ Form::number('price', old('price'), ['class' => 'form-control', 'step' => '0.01']) }}
		</div>
		<div class="form-group">
			{{ Form::label('product_category_id', 'Categoria') }}
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_product_categories">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('product_category_id', $product_categories->pluck('name', 'id'), old('product_category_id'), ['class' => 'form-control', 'placeholder' => 'Selecione uma categoria']) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('color_id', 'Cor') }}
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_colors">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('color_id', $colors->pluck('value', 'id'), old('color_id'), ['class' => 'form-control', 'placeholder' => 'Nada selecionado']) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('size_id', 'Tamanho') }}
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_sizes">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('size_id', $sizes->pluck('value', 'id'), old('size_id'), ['class' => 'form-control', 'placeholder' => 'Nada selecionado']) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('subsidiary_id', 'Filial') }}
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_subsidiaries">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('subsidiary_id', $subsidiaries->pluck('name', 'id'), old('subsidiary_id'), ['class' => 'form-control', 'placeholder' => 'Nada selecionado']) }}
			</div>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::label('min_qty', 'Quantidade Mínima') }}
			{{ Form::number('min_qty', old('min_qty'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('discount_limit', 'Limite de Desconto (%)') }}
			{{ Form::number('discount_limit', old('discount_limit'), ['class' => 'form-control', 'step' => '0.01']) }}
		</div>
		<div class="form-group">
			{{ Form::label('multiple', 'Múltiplo') }}
			{{ Form::number('multiple', old('multiple'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('ipi', 'Ipi') }}
			{{ Form::number('ipi', old('ipi'), ['class' => 'form-control', 'step' => '0.01']) }}
		</div>
		@if(isset($product))
		<div class="d-flex flex-column flex-md-row">
			<img src="{{ url($product->image) }}" alt="..." class="img-thumbnail mr-md-4 mb-3 mb-md-0" style="height: 200px;">
			<div id="dz-image" class="dropzone" style="display: inline-block; height:200px;"></div>
		</div>
		@endif
	</div>
</div>
<div class="form-group">
	{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
</div>
{{ Form::close() }}

@if(isset($product))
<!-- Estoque -->
<hr>
<h3>Estoque</h3>
<div class="row">
	<div class="col">
		{{ Form::model($product_stock, ['route' => ['product_stocks.update', $product_stock], 'method' => 'put']) }}
		{{ Form::label('qty_now', 'Estoque Atual') }}
		<div class="form-group">
			<div class="input-group">
				{{ Form::number('qty_now', old('qty_now'), ['class' => 'form-control', 'step' => '1']) }}
				<span class="input-group-append">
					{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
				</span>
			</div>
		</div>
		{{ Form::close() }}
	</div>
	<div class="col">
		{{ Form::model($product_stock, ['route' => ['product_stocks.update', $product_stock], 'method' => 'put']) }}
		{{ Form::label('qty_future', 'Estoque Futuro') }}
		<div class="form-group">
			<div class="input-group">
				{{ Form::number('qty_future', old('qty_future'), ['class' => 'form-control', 'step' => '1']) }}
				<span class="input-group-append">
					{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
				</span>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
<div class="row">
	<div class="col">
		{{ Form::model($product_stock, ['route' => ['product_stocks.update', $product_stock], 'method' => 'put']) }}
		{{ Form::label('date_now', 'Data Atual') }}
		<div class="form-group">
			<div class="input-group">
				{{ Form::date('date_now', old('date_now'), ['class' => 'form-control']) }}
				<span class="input-group-append">
					{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
				</span>
			</div>
		</div>
		{{ Form::close() }}
	</div>
	<div class="col">
		{{ Form::model($product_stock, ['route' => ['product_stocks.update', $product_stock], 'method' => 'put']) }}
		{{ Form::label('date_future', 'Data Futura') }}
		<div class="form-group">
			<div class="input-group">
				{{ Form::date('date_future', old('date_future'), ['class' => 'form-control']) }}
				<span class="input-group-append">
					{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
				</span>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
<hr>
<!-- Preço por quantidade -->
<h3>Preço por Quantidade</h3>
{{ Form::open(['route' => ['price_quantities.store', $product], 'method' => 'post']) }}
<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::number('price', old('price'), ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Preço']) }}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::number('qty', old('qty'), ['class' => 'form-control', 'step' => '1', 'placeholder' => 'Quantidade']) }}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>
{{ Form::close() }}

<table class="table table-responsive-sm bg-white table-hover border">
	<thead>
		<tr>
			<th>Preço</th>
			<th>Quantidade</th>
			<th class="text-right">Ações</th>
		</tr>
	</thead>
	<tbody>
		@foreach($product->price_quantities as $price_quantity)
		<tr>
			<td class="align-middle">@currency($price_quantity->price)</td>
			<td class="align-middle">{{ $price_quantity->qty }}</td>
			<td class="text-right align-middle">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#price_quantities_destroy_{{ $product->id }}"><i class="cil-trash"></i></button>
			</td>
			@modal_destroy(['route_destroy' => 'price_quantities.destroy', 'model' => $price_quantity, 'modal_id' => 'price_quantities_destroy_'.$price_quantity->id])
		</tr>
		@endforeach
	</tbody>
</table>
<!-- Tabela de Preços -->
<hr>
<h3>Tabela de Preço</h3>
{{ Form::open(['route' => ['product_price_tables.store', $product], 'method' => 'post']) }}
{{ Form::hidden('product_id', $product->id) }}
<div class="row">
	<div class="col">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_price_tables">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('price_table_id', $price_tables->pluck('name', 'id'), old('price_table_id'), ['class' => 'form-control', 'placeholder' => 'Nada selecionado']) }}
			</div>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
		{{ Form::number('price', old('price'), ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Preço']) }}
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
		</div>
	</div>
</div>
{{ Form::close() }}
@include('dashboard::clients.modals.create_price_tables')

<table class="table table-responsive-sm bg-white table-hover border">
	<thead>
		<tr>
			<th>Tabela</th>
			<th>Preço</th>
			<th class="text-right">Ações</th>
		</tr>
	</thead>
	<tbody>
		@foreach($product->product_price_tables as $product_price_table)
		<tr>
		<td class="align-middle">{{ $product_price_table->price_table->name }}</td>
			<td class="align-middle">@currency($product_price_table->price)</td>
			<td class="text-right align-middle">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#product_price_tables_destroy_{{ $product_price_table->id }}"><i class="cil-trash"></i></button>
			</td>
			@modal_destroy(['route_destroy' => 'product_price_tables.destroy', 'model' => $product_price_table, 'modal_id' => 'product_price_tables_destroy_'.$product_price_table->id])
		</tr>
		@endforeach
	</tbody>
</table>

@push('styles')
{{ Html::style('modules/dashboard/dropzone/dropzone.css') }}
@endpush


@push('scripts')
{{ Html::script('modules/dashboard/dropzone/dropzone.js') }}
<script>
	Dropzone.autoDiscover = false;

	var dz_logo = new Dropzone('#dz-image', {
		url: '{{ route("products.store.image", $product) }}',
		headers: {
			'X-CSRF-Token': "{{ csrf_token() }}"
		},
		dictDefaultMessage: 'Upload da Imagem do Produto',
		success: function(file, response, xhr) {
			window.location.replace("{{ route('products.edit', $product) }}");
		}
	});
</script>

@endpush
@endif

@include('dashboard::products.modals.create_product_categories')
@include('dashboard::products.modals.create_colors')
@include('dashboard::products.modals.create_sizes')
@include('dashboard::products.modals.create_subsidiaries')
