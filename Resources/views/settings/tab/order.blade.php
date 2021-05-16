	{{ Form::model($setting_order, ['route' => 'settings.order.update', 'method' => 'put']) }}

	<div class="form-group">
		{{ Form::label('order_start', 'Número inicial dos pedidos') }}
		{{ Form::number('order_start', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group row">
		{{ Form::label('buyer', 'Comprador', ['class' => 'col-sm-4 col-form-label']) }}
		<div class="col-sm-10">
			<label class="c-switch c-switch-primary c-switch-lg mb-0 ml-3">
				{{ Form::hidden('buyer', 0) }}
				{{ Form::checkbox('buyer', 1, null,['class' => 'c-switch-input']) }}
				<span class="c-switch-slider"></span>
			</label>
		</div>
	</div>
	<hr>
	<div class="form-group">
		{{ Form::label('number_copies', 'Número de vias') }}
		{{ Form::text('number_copies', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group row">
		{{ Form::label('auto', 'Impressão Automática', ['class' => 'col-sm-2 col-form-label']) }}
		<div class="col-sm-10">
			<label class="c-switch c-switch-primary c-switch-lg mb-0 ml-3">
				{{ Form::hidden('auto', 0) }}
				{{ Form::checkbox('auto', 1, null,['class' => 'c-switch-input']) }}
				<span class="c-switch-slider"></span>
			</label>
		</div>
	</div>

	{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
	{{ Form::close() }}