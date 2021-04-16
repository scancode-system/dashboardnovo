@extends('dashboard::layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			<nav class="mb-3">
					<div class="nav nav-tabs" role="tablist">
						<a class="nav-item nav-link {{ ($tab==0)?'active':'' }}" href="{{ route('companies.edit', 0) }}" >Dados da Empresa</a>
						<a class="nav-item nav-link {{ ($tab==1)?'active':'' }}" href="{{ route('companies.edit', 1) }}">Endereço</a>
					</div>
				</nav>
				<div class="tab-content">
					<div class="tab-pane {{ ($tab==0)?'show active':'' }}" >
						@include('dashboard::companies.tab.info')
					</div>
					<div class="tab-pane {{ ($tab==1)?'show active':'' }}">
						@include('dashboard::companies.tab.address')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
	Empresa
</li>
@endsection


@push('scripts')

{{ Html::script('modules/dashboard/coreui/dist/vendors/jquery.maskedinput/js/jquery.maskedinput.js') }}
<script>
	$('[name="phone"]').mask('(99) 999999999');
	$('[name="cnpj"]').mask('99.999.999/9999-99');
	$('[name="state_registration"]').mask('999.999.999.999');

	$('[name="postcode"]').mask('99999-999');
</script>

@endpush