@extends('dashboard::layouts.master')

@section('content')
<div class="card">
    @search_add(['search' => $search, 'route_search' => 'sallers.index', 'route_add' => 'sallers.create'])
    <div class="card-body">
        <table class="table table-responsive-sm bg-white table-hover border">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Meta</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sallers as $saller)
                <tr>
                    <td class="align-middle">{{ $saller->name }}</td>
                    <td class="align-middle">{{ $saller->login }}</td>
                    <td class="align-middle">{{ $saller->email }}</td>
                    <td class="align-middle">@currency($saller->goal)</td>
                    <td class="text-right align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sallers_view_{{ $saller->id }}"><i class="cil-search"></i></button>
                            <a href="{{ route('sallers.edit', $saller) }}" class="btn btn-primary"><i class="cil-pencil"></i></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sallers_destroy_{{ $saller->id }}"><i class="cil-trash"></i></button>
                        </div>
                    </td>
                    @include('dashboard::sallers.modals.view_saller')
                    @modal_destroy(['route_destroy' => 'sallers.destroy', 'model' => $saller->id, 'modal_id' => 'sallers_destroy_'.$saller->id])
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $sallers->links() }}
    </div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Representantes
</li>
@endsection
