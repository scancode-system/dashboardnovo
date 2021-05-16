<?php

namespace Modules\Dashboard\Services\Order;

use Modules\Dashboard\Entities\OrderPayment;

class UpdateOrderPaymentService
{


	public function __invoke(OrderPayment $order_payment)
	{
		$payment = $order_payment->order->payment;
		if ($payment) {
			$order_payment->description = $payment->description;
			$order_payment->discount = $payment->discount;
			$order_payment->addition = $payment->addition;
		} else {
			$order_payment->description = null;
			$order_payment->discount = 0;
			$order_payment->addition = 0;
		}
		$order_payment->save();
	}
}
