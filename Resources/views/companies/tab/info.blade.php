<div class="row">
	<div class="col">
		{{ Form::model($company, ['route' => 'company.update', 'method' => 'put']) }}
		<div class="form-group">
			{{ Form::label('cnpj', 'CNPJ') }}
			{{ Form::text('cnpj', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('corporate_name', 'Razão Social') }}
			{{ Form::text('corporate_name', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('fantasy_name', 'Nome Fantasia') }}
			{{ Form::text('fantasy_name', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('state_registration', 'Inscrição Estadual') }}
			{{ Form::text('state_registration', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('phone', 'Telefone') }}
			{{ Form::text('phone', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			{{ Form::email('email', null, ['class' => 'form-control']) }}
		</div>
		{{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
	</div>
	{{ Form::close() }}
	<div class="col">
		<div id="dz-logo" class="dropzone h-100"></div>
	</div>
</div>


@push('styles')
{{ Html::style('modules/dashboard/dropzone/dropzone.css') }}
@endpush


@push('scripts')
{{ Html::script('modules/dashboard/dropzone/dropzone.js') }}


<script>
	Dropzone.autoDiscover = false;

	var dz_logo = new Dropzone('#dz-logo', {
		url: '{{ route("companies.logo") }}',
		headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
		dictDefaultMessage: 'Faça o upload da sua LOGO aqui',
		success: function(file, response, xhr){
            window.location.replace("{{ route('companies.edit', 0) }}");
        }
	});
</script>

@endpush
