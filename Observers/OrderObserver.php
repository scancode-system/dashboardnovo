<?php

namespace Modules\Dashboard\Observers;

use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Status;
use Modules\Dashboard\Entities\OrderClient;
use Modules\Dashboard\Entities\OrderPayment;
use Modules\Dashboard\Services\Order\PrintAutoService;
use Modules\Dashboard\Services\Order\CheckOrderToCloseService;
use Modules\Dashboard\Services\Order\UpdateOrderClientService;
use Modules\Dashboard\Services\Order\UpdateOrderPaymentService;

class OrderObserver
{

	public function saved(Order $order)
	{
		if ($order->isDirty('payment_id')) {
			(new UpdateOrderPaymentService())($order->order_payment);
		}
		if ($order->isDirty('client_id')) {
			(new UpdateOrderClientService())($order->order_client);
		}
	}

	public function created(Order $order)
	{
		OrderPayment::create(['order_id' => $order->id]);
		OrderClient::create(['order_id' => $order->id]);
		(new UpdateOrderClientService())($order->order_client);
	}

	public function updating(Order $order)
	{
		if ($order->isDirty('status_id')) {
			if ($order->status_id == Status::COMPLETED) {
				(new CheckOrderToCloseService())($order);
			} else {
				$order->closing_date = null;
			}
		}
	}

	public function updated(Order $order)
	{
		if ($order->isDirty('status_id')) {
			if ($order->status_id == Status::COMPLETED) {
				(new PrintAutoService())($order);
			} 
		}
	}
}
