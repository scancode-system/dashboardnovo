<div class="row">
	<div class="col">
		{{ Form::model($company, ['route' => 'company.update', 'method' => 'put']) }}
		<div class="form-group">
			{{ Form::label('street', 'Rua') }}
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
		{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
		{{ Form::close() }}
	</div>
</div>