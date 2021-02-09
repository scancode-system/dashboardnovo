@if(isset($saller))
{{ Form::model($saller, ['route' => ['sallers.update', $saller], 'method' => 'put']) }}
{{ Form::hidden('id', $saller->id) }}
@else
{{ Form::open(['route' => 'sallers.store']) }}
@endif
<div class="form-group">
	{{ Form::label('name', 'Nome') }}
	{{ Form::text('name', old('name'), ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('login', 'Login') }}
	{{ Form::text('login', old('login'), ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::text('email', old('email'), ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('goal', 'Meta') }}
	{{ Form::number('goal', old('price'), ['class' => 'form-control', 'step' => '0.01']) }}
</div>
<div class="form-group">
	{{ Form::label('password', 'Senha') }}
	{{ Form::password('password', ['class' => 'form-control']) }}
</div>
<div class="form-group  mb-0">
	{{ Form::button('<i class="cil-save"></i>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
</div>
{{ Form::close() }}
