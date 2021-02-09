<div class="card-header">
	<div class="row">
		<div class="col">
			{{  Form::open(['route' => $route_search, 'method' => 'get']) }}
			<div class="input-group">
				<span class="input-group-prepend">
					{{ Form::button('<i class="cil-search"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
				</span>
				{{ Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'Pesquisar']) }}
			</div>
			{{ Form::close() }}
		</div>
		<div class="col text-right">
			<a href="{{ route($route_add) }}" class="btn btn-brand btn-primary">
				<i class="cil-plus btn-icon"></i>
			</a>
		</div>
	</div>
</div>