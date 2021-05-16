<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderClient extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'buyer', 'phone', 'email', 'shipping_id', 'shipping'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\OrderBuyerFactory::new();
    }

    /**relationship */
    public function order()
	{
		return $this->belongsTo(Order::class);
    }
}
