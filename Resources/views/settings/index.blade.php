@extends('dashboard::layouts.master')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
            <nav class="mb-3">
					<div class="nav nav-tabs" role="tablist">
						<a class="nav-item nav-link {{ ($tab==0)?'active':'' }}" href="{{ route('settings.index', 0) }}" >Usuários</a>
                        <a class="nav-item nav-link {{ ($tab==1)?'active':'' }}" href="{{ route('settings.index', 1) }}">Cliente</a>
                        <a class="nav-item nav-link {{ ($tab==2)?'active':'' }}" href="{{ route('settings.index', 2) }}">Evento</a>
                        <a class="nav-item nav-link {{ ($tab==3)?'active':'' }}" href="{{ route('settings.index', 3) }}">Pedido</a>
                        <a class="nav-item nav-link {{ ($tab==4)?'active':'' }}" href="{{ route('settings.index', 4) }}">PDF</a>
                        <a class="nav-item nav-link {{ ($tab==5)?'active':'' }}" href="{{ route('settings.index', 5) }}">Impressora</a>
					</div>
				</nav>
				<div class="tab-content">
					<div class="tab-pane {{ ($tab==0)?'show active':'' }}" >
						@include('dashboard::settings.tab.users')
					</div>
					<div class="tab-pane {{ ($tab==1)?'show active':'' }}" >
						@include('dashboard::settings.tab.client')
					</div>
					<div class="tab-pane {{ ($tab==3)?'show active':'' }}" >
						@include('dashboard::settings.tab.order')
					</div>
					<div class="tab-pane {{ ($tab==4)?'show active':'' }}" >
						@include('dashboard::settings.tab.pdf')
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
	Sistema
</li>
@endsection