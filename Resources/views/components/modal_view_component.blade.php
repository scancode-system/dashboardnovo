<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ $slot }}
			</div>
			@if(isset($edit_route))
			<div class="modal-footer justify-content-start">
				<a href="{{ route($edit_route, [$model_id]) }}" class="btn btn-brand btn-primary">
					<i class="fa fa-edit"></i><span>Editar</span>
				</a>
			</div>
			@endif
		</div>
	</div>
</div>