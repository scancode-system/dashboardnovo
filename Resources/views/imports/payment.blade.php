@extends('dashboard::layouts.master')

@section('content')
@include('dashboard::imports.widget.index', ['import_class' => 'PaymentsImport', 'clear' => true, 'dropzone' => true])
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Importar Pagamentos
</li>
@endsection
