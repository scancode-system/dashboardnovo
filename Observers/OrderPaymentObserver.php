<?php

namespace Modules\Dashboard\Observers;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Payment;
use Modules\Dashboard\Entities\OrderPayment;

class OrderPaymentObserver
{


	public function updating(OrderPayment $order_payment)
	{
		/*$payment = Payment::find($order_payment->payment_id);
		if($payment){
			$order_payment->description = $payment->description;
			$order_payment->discount = $payment->discount;
			$order_payment->addition = $payment->addition;
		} else {
			$order_payment->description = null;
			$order_payment->discount = 0;
			$order_payment->addition = 0;
		}*/
	}

	public function updated(OrderPayment $order_payment){
		$this->giveDiscounts($order_payment);
		$this->giveAdditions($order_payment);
	}

	private function giveDiscounts($order_payment){
		$items = $order_payment->order->items;
		foreach ($items as $item) {
			$discount = $order_payment->discount;
			if($item->product->discount_limit < $discount){
				$discount = $item->product->discount_limit;
			}
			if($discount > $item->discount){
				$item->updateDiscount($discount);
			}
		}
	}

	private function giveAdditions($order_payment){
		Item::updateItemsAdditionByOrder($order_payment->order, $order_payment->addition);
	}
}
