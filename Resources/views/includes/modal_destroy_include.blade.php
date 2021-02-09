<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-smd" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>O registro selecionado sera deletado caso confirme, e não tera como recupera-lo posteriormente. Deseja realmente prosseguir?</p>
				{{ Form::open(['route' => [$route_destroy, $model], 'method' => 'delete']) }}
				{{ Form::submit('Sim', ['class' => 'btn btn-danger']) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>	