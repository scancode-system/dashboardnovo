<?php

namespace Modules\Dashboard\Services\Order;

use Exception;
use Carbon\Carbon;
use Modules\Dashboard\Entities\Order;
use Modules\Dashboard\Entities\Status;

class CheckOrderToCloseService
{


	public function __invoke(Order $order)
	{
		if (!$order->print_auto) {
			$order->print_auto = false;
		}

		$message = null;
		if (is_null($order->client_id)) {
			$message = 'Cliente não selecinado';
		} else if (is_null($order->order_client->buyer) && (SettingOrder::get())->buyer) {
			$message = 'Comprador não selecionado';
		} else if (is_null($order->saller_id)) {
			$message = 'Representante não selecinado';
		} else if (is_null($order->payment_id)) {
			$message = 'Pagamento não selecinado';
		} else if ($order->payment->min_value > $order->total) {
			$message = 'O Valor da compra não atingiu o valor mínimo para esta forma de pagamento';
		}

		if (!is_null($message)) {
			throw new Exception($message);
		} else {
			$order->closing_date = Carbon::now();
		}
	}
}
