<?php

namespace Modules\Dashboard\Entities;

use Modules\Dashboard\Entities\Order;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'order_id', 'payment_id', 'description', 'discount', 'addition'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\OrderPaymentFactory::new();
    }

    /**relationship */
    public function order()
	{
		return $this->belongsTo(Order::class);
    }

    public function payment()
	{
		return $this->belongsTo(Payment::class);
    }

}
