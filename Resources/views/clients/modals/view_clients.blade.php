<x-modal_view :modal-id="'clients_view_'.$client->id" edit-route="clients.edit" :model_id="$client->id">

@slot('title')
Cliente #{{ '1' }}
@endslot

<h5>Dados</h5>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Nome Fantasia: </strong></div>
	<div class="col-md-5">{{ $client->fantasy_name }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Razão Social: </strong></div>
	<div class="col-md-5">{{ $client->corporate_name }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>CPF/CNPJ: </strong></div>
	<div class="col-md-5">{{ $client->cpf_cnpj }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Nome Comprador: </strong></div>
	<div class="col-md-5">{{ $client->buyer }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Email: </strong></div>
	<div class="col-md-5">{{ $client->email }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Telefone: </strong></div>
	<div class="col-md-5">{{ $client->phone }}</div>
</div>
<hr>
<h5>Endereço</h5>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Rua: </strong></div>
	<div class="col-md-5">{{ $client->street }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Número: </strong></div>
	<div class="col-md-5">{{ $client->number }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Complemento: </strong></div>
	<div class="col-md-5">{{ $client->apartment }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Bairro: </strong></div>
	<div class="col-md-5">{{ $client->neighborhood }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>Cidade: </strong></div>
	<div class="col-md-5">{{ $client->city }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>UF: </strong></div>
	<div class="col-md-5">{{ $client->st }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col-md-5"><strong>CEP: </strong></div>
	<div class="col-md-5">{{ $client->postcode }}</div>
</div>
</x-modal_view>


