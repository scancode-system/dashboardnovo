<x-modal_view :modal-id="'sallers_view_'.$saller->id" edit-route="sallers.edit" :model_id="$saller">

@slot('title')
Representante #{{ $saller->id }}
@endslot

<div class="row  mb-1">
	<div class="col-md-3"><strong>Nome: </strong></div>
	<div class="col-md-9">{{ $saller->name }}</div>
</div>
<div class="row mb-1">
	<div class="col-md-3"><strong>Login: </strong></div>
	<div class="col-md-9">{{ $saller->login }}</div>
</div>
<div class="row mb-1">
	<div class="col-md-3"><strong>Email: </strong></div>
	<div class="col-md-9">{{ $saller->email }}</div>
</div>
<div class="row mb-1">
	<div class="col-md-3"><strong>Meta: </strong></div>
	<div class="col-md-9">@currency($saller->goal)</div>
</div>

</x-modal_view>