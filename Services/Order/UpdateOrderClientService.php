<?php

namespace Modules\Dashboard\Services\Order;

use Modules\Dashboard\Entities\OrderClient;

class UpdateOrderClientService
{


	public function __invoke(OrderClient $order_client)
	{
		$client = $order_client->order->client;
		$order_client->buyer = $client->buyer;
		$order_client->phone = $client->phone;
		$order_client->email = $client->email;
		
		$order_client->shipping_id = $client->shipping_id;
		if(is_null($order_client->shipping_id)){
			$order_client->shipping = null;
		} else {
			$order_client->shipping = $client->shipping->name;
		}
		$order_client->save();
	}
}
