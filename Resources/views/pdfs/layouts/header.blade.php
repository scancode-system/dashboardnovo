<table class="w-100">
	<tr>
		<td>{{ $setting_pdf->title }}</td>
		<td class="text-right">Pedido: {{ $order->id }}</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark align-top text-center">
			<p class="border-dark-2 border-bottom p-1 mb-3 text-left">DADOS DA EMPRESA</p>
			<div class="text-center mb-3">
				<img src="{{ url($company->logo) }}" class="height-75">
			</div>
			<div>{{ $company->fantasy_name ?? 'N/A' }}</div>
			<div>{{ $company->email ?? 'N/A' }}</div>
			<div class="mb-3">{{ $company->phone ?? 'N/A' }}</div>
			<div class="mb-2">
				{{ $company->street ?? 'N/A' }}, 
				{{ $company->number ?? 'N/A' }} - 
				{{ $company->neighborhood ?? 'N/A' }}<br>
				{{ $company->city }}/{{ $company->st ?? 'N/A' }}<br>
				{{ $company->postcode ?? 'N/A' }}
			</div>
		</td>
		<td class="width-10"></td>
		<td class="border border-dark w-65 p-0 align-top pb-2">
			<p class="border-bottom border-dark-2 p-1 mb-2 ">DADOS DO CLIENTE: {{ $order->order_client->client_id }}</p>
			<div class="px-2">
				<table class="w-100">
					<tr>
						<td class="w-50">
							<div>
								<strong>Razão Social:</strong><br>
								{{ $order->client->corporate_name ?? 'N/A' }}
							</div>
							<div>
								<strong>Nome Fantaisa:</strong><br>
								{{ $order->client->fantasy_name ?? 'N/A' }}
							</div>
							<div>
								<strong>CPF/CNPJ:</strong><br>
								{{ $order->client->cpf_cnpj ?? 'N/A' }}
							</div>
							<div>
								<strong>Comprador:</strong><br>
								{{ $order->order_client->buyer ?? 'N/A' }}
							</div>
							<div>
								<strong>Telefone:</strong><br>
								{{ $order->order_client->phone  ?? 'N/A' }}
							</div>
							<div>
								<strong>Email:</strong><br>
								{{ $order->order_client->email ?? 'N/A' }}
							</div>
						</td>
						<td class="w-50">
							<div>
								<strong>Rua:</strong><br>
								{{ $order->client->street ?? 'N/A' }}
							</div>
							<div>
								<strong>Número:</strong><br>
								{{ $order->client->number ?? 'N/A' }}
							</div>
							<div>
								<strong>Bairro:</strong><br>
								{{ $order->client->neighborhood ?? 'N/A' }}
							</div>
							<div>
								<strong>Cidade:</strong><br>
								{{ $order->client->city ?? 'N/A' }}
							</div>
							<div>
								<strong>Estado:</strong><br>
								{{ $order->client->st ?? 'N/A' }}
							</div>
							<div>
								<strong>CEP:</strong><br>
								{{ $order->client->postcode ?? 'N/A' }}
							</div>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark">
			<p class="border-bottom border-dark-2 p-1 mb-0" >Representante</p>
			<table class="w-100 m-2">
				<tr>
					<td><strong>Codigo: </strong>{{ $order->saller_id }}</td>
					<td><strong>Nome: </strong>{{ $order->saller->name }}</td>
					<td><strong>Email: </strong>{{ $order->saller->email }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark">
			<p class="border-bottom border-dark-2 p-1 mb-0" >Detalhes do Pedido</p>
			<table class="w-100 m-2">
				<tr>
					<td><strong>Pagamento: </strong>{{ $order->order_payment->description }}</td>
					<td><strong>Transportadora: </strong>{{ $order->order_client->shipping }}</td>
					<td><strong>Entrega: </strong>{{ $order->delivery_name }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

