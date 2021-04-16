@extends('dashboard::layouts.master')

@section('content')

<div class="card">
	@search_add(['route_search' => 'clients.index', 'route_add' => 'clients.create'])
	<div class="card-body">
		<table class="table table-responsive-sm bg-white table-hover border">
			<thead>
				<tr>
					<th>Cod</th>
					<th>Razão Social</th>
					<th>CPF/CNPJ</th>
					<th>Comprador</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>Estado</th>
					<th class="text-right">Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($clients as $client)

				<tr>
					<td class="align-middle">#{{ $client->id }}</td>
					<td class="align-middle">{{ $client->corporate_name }}</td>
					<td class="align-middle">{{ $client->cpf_cnpj }}</td>
					<td class="align-middle">{{ $client->buyer }}</td>
					<td class="align-middle">{{ $client->email }}</td>
					<td class="align-middle">{{ $client->phone }}</td>
					<td class="align-middle">{{ $client->st }}</td>

					<td class="text-right align-middle">
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#clients_view_{{ $client->id }}"><i class="cil-search"></i></button>
							<a href="{{ route('clients.edit', $client) }}" class="btn btn-primary"><i class="cil-pencil"></i></a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#clients_destroy_{{ $client->id }}"><i class="cil-trash"></i></button>
						</div>
					</td>
					@include('dashboard::clients.modals.view_clients')
					@modal_destroy(['route_destroy' => 'clients.destroy', 'model' => $client, 'modal_id' => 'clients_destroy_'.$client->id])
				</tr>

				@endforeach
			</tbody>
		</table>
		{{ $clients->links() }}
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Clientes
</li>
@endsection