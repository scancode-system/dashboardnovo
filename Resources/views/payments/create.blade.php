@extends('dashboard::layouts.master')

@section('content')

<div class="card">
	<div class="card-header">
		<i class="fa fa-plus-square-o"></i> Novo Pagamento
	</div>
	<div class="card-body">
		@include('dashboard::payments.form')
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ route('payments.index') }}">Pagamentos</a>
</li>
<li class="breadcrumb-item">
	Adicionar Pagamento
</li>
@endsection
