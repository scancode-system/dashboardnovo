@extends('dashboard::layouts.master')

@section('content')

<div class="card">
	@search_add(['route_search' => 'payments.index', 'route_add' => 'payments.create'])
	<div class="card-body">
		<table class="table table-responsive-sm bg-white table-hover border">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Valor Mínimo</th>
					<th>Desconto</th>
					<th>Acréscimo</th>
					<th>Visivel</th>
					<th class="text-right">Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($payments as $payment)
				<tr>
					<td class="align-middle">{{ $payment->description }}</td>
					<td class="align-middle">@currency($payment->min_value)</td>
					<td class="align-middle">@percentage($payment->discount)</td>
					<td class="align-middle">@percentage($payment->addition)</td>
					<td class="align-middle">{{ ($payment->visible)?'Sim':'Não' }}</td>
					<td class="text-right align-middle">
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#payments_view_{{ $payment->id }}"><i class="cil-search"></i></button>
							<a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary"><i class="cil-pencil"></i></a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#payments_destroy_{{ $payment->id }}"><i class="cil-trash"></i></button>
						</div>
					</td>
					@include('dashboard::payments.modals.view_payment')
					@modal_destroy(['route_destroy' => 'payments.destroy', 'model' => $payment, 'modal_id' => 'payments_destroy_'.$payment->id])
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $payments->links() }}
	</div>
</div>

@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Pagamentos
</li>
@endsection