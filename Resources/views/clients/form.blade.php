@if(isset($client))
{{ Form::model($client, ['route' => ['clients.update', $client], 'method' => 'put']) }}
{{ Form::hidden('id', $client->id) }}
@else
{{ Form::open(['route' => 'clients.store']) }}
@endif
 
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('corporate_name', 'Razão Social') }}
			{{ Form::text('corporate_name', old('corporate_name'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('fantasy_name', 'Nome Fantasia') }}
			{{ Form::text('fantasy_name', old('fantasy_name'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('cpf_cnpj', 'CPF/CNPJ') }}
			{{ Form::text('cpf_cnpj', old('cpf_cnpj'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('buyer', 'Comprador') }}
			{{ Form::text('buyer', old('buyer'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			{{ Form::text('email', old('email'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('phone', 'Telefone') }}
			{{ Form::text('phone', old('phone'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('shipping_company_id', 'Transportadora') }}
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_shipping_companies">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('shipping_id', $shippings, old('shipping_id'), ['class' => 'form-control', 'placeholder' => 'Selecione uma transportadora']) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('price_table_id', 'Tabela de Preço') }}
			<div class="input-group">
				<span class="input-group-prepend" data-toggle="modal" data-target="#modal_create_price_tables">
					{{ Form::button('<i class="cil-plus btn-icon"></i>', ['class' => 'btn btn-primary']) }}
				</span>
				{{ Form::select('price_table_id', $price_tables->pluck('name', 'id'), old('price_table_id'), ['class' => 'form-control', 'placeholder' => 'Nada selecionado']) }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('street', 'Rua/AV') }}
			{{ Form::text('street', old('street'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('number', 'Número') }}
			{{ Form::number('number', old('number'), ['class' => 'form-control', 'step' => '0.1']) }}
		</div>
		<div class="form-group">
			{{ Form::label('apartment', 'Apartamento') }}
			{{ Form::text('apartment', old('apartment'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('neighborhood', 'Bairro') }}
			{{ Form::text('neighborhood', old('neighborhood'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('city', 'Cidade') }}
			{{ Form::text('city', old('city'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('st', 'Estado') }}
			{{ Form::text('st', old('st'), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('postcode', 'CEP') }}
			{{ Form::text('postcode', old('postcode'), ['class' => 'form-control']) }}
		</div>
	</div>
</div>
<div class="form-group  mb-0">
	{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
</div>
{{ Form::close() }}

@include('dashboard::clients.modals.modal_create_shipping_companies')
@include('dashboard::clients.modals.create_price_tables')