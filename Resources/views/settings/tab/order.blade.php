	{{ Form::model($setting_order, ['route' => 'settings.order.update', 'method' => 'put']) }}

	<div class="form-group">
		{{ Form::label('order_start', 'Número inicial dos pedidos') }}
		{{ Form::number('order_start', null, ['class' => 'form-control']) }}
	</div>
	<div class="row">
		<div class="col">
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
		</div>
	</div>

	{{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
	{{ Form::close() }}