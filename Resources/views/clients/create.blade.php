@extends('dashboard::layouts.master')

@section('content')

<div class="card">
	<div class="card-header">
		<i class="fa fa-plus-square-o"></i> Novo Cliente
	</div>
	<div class="card-body">
		@include('dashboard::clients.form')
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ route('clients.index') }}">Clientes</a>
</li>
<li class="breadcrumb-item">
	Adicionar Cliente
</li>
@endsection
