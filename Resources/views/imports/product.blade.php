@extends('dashboard::layouts.master')

@section('content')
<div class="card">
	<div class="card-header">
		<h2>Configuração de Importação</h2>
	</div>
	<div class="card-body">
		{{ Form::open(['route' => 'imports.product.setting', 'method' => 'put']) }}
		<div class="row">
			<div class="col">
				<div class="form-group row">
					{{ Form::label('sales_on', 'Contabilizar Produtos Vendidos', ['class' => 'col-sm-4 col-form-label']) }}
					<div class="col-sm-8">
						<label class="c-switch c-switch-primary c-switch-lg mb-0 ml-3">
							{{ Form::hidden('sales_on', 0) }}
							{{ Form::checkbox('sales_on', 1, session('sales_on', false),['class' => 'c-switch-input']) }}
							<span class="c-switch-slider"></span>
						</label>
					</div>
				</div>
			</div>
		</div>
		{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
		{{ Form::close() }}
	</div>
</div>
@include('dashboard::imports.widget.index', ['import_class' => 'ProductsImport', 'clear' => true, 'dropzone' => true])
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Importar Clientes
</li>
@endsection