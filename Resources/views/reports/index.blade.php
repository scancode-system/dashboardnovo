@extends('dashboard::layouts.master')

@section('content')
<div class="card">
    <h5 class="card-header">Relatórios</h5>
    <div class="card-body">
        @foreach($report_categories as $report_category)
        <h2>{{ $report_category->name }}</h2>
        <div class="d-flex p-2">
            @foreach($report_category->reports as $report)
            <a href="{{ route('reports.download', $report->id) }}" class="btn btn-outline-success mr-3 py-3 flex-fill"><span class="cil-file btn-icon mr-2"></span> {{ $report->alias }}</a>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
    Relatórios
</li>
@endsection