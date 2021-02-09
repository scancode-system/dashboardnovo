@extends('dashboard::layouts.master')

@section('content')

<div class="card">
	<div class="card-header lead">
		<i class="fa fa-plus-square-o"></i> Novo Representante
	</div>
	<div class="card-body">
		@include('dashboard::sallers.form')
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ route('sallers.index') }}">Representantes</a>
</li>
<li class="breadcrumb-item">
	Adicionar Representante
</li>
@endsection