<?php

namespace Modules\Dashboard\Entities;

use Modules\Dashboard\Entities\Item;
use Modules\Dashboard\Entities\Client;
use Modules\Dashboard\Entities\Status;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Payment;
use Modules\Dashboard\Entities\OrderPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'client_id', 'saller_id', 'payment_id', 'status_id', 'full_delivery', 'closing_date', 'observation', 'signature'];
    protected $dates = [
        'closing_date'
    ];

    protected $hidden = ['signature'];

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\OrderFactory::new();
    }

    /**relaionship */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function saller()
    {
        return $this->belongsTo(Saller::class);
	}
	
	public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function order_payment()
    {
        return $this->hasOne(OrderPayment::class);
    }

    public function order_client()
    {
        return $this->hasOne(OrderClient::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
	}
	
	public function items_now()
    {
        return $this->hasMany(Item::class)->whereHas('item_stock', function($q) {
				$q->where('qty_now', '>', 0);
		});
	}
	
	public function items_future()
    {
        return $this->hasMany(Item::class)->whereHas('item_stock', function($q) {
				$q->where('qty_future', '>', 0);
		});
    }

    /**Repository */
    protected static function search($search, $limit = 10)
    {
        $orders =  Order::where('id', $search)->orWhereHas('client', function ($query) use ($search) {
                $query->where('corporate_name', 'like', '%' . $search . '%');
            })->orWhereHas('saller', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('status', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->with(['client', 'saller', 'order_payment', 'items'])->paginate($limit);

        $orders->appends(request()->query());
        return $orders;
    }
	
	public function clone(){

		$order_cloned = $this->replicate();
		$order_cloned->status_id = Status::OPEN;
		$order_cloned->save();

		foreach ($this->items as $item) {
			$item_cloned = $item->replicate();
			$item_cloned->order_id = $order_cloned->id;
			$item_cloned->save();
		}

		return $order_cloned;
	}

	public static function loadClosedOrders(){
		return Order::where('status_id', Status::COMPLETED)->get();
	}

    /**accessors */
	public function getSignatureCheckAttribute($value)
	{
		if(is_null($this->signature))
		{
			return false;
		} else 
		{
			return true;
		}
	}

	public function getTotalItemsAttribute($value)
	{
		$sum = 0;
		foreach ($this->items as $item) {
			$sum+= $item->qty;
		}
		return $sum;
	}

	public function getTotalAttribute($value)
	{
		$sum = 0;
		foreach ($this->items as $item) {
			$sum+= $item->total;
		}
		return $sum;
	}


	public function getTotalGrossAttribute($value)
	{
		$sum = 0;
		foreach ($this->items as $item) {
			$sum+= $item->total_gross;
		}
		return $sum;
	}


	public function getDiscountValueAttribute($value)
	{
		$sum = 0;
		foreach ($this->items as $item) {
			$sum+= $item->total_discount_value;
		}
		return $sum;
	}

	public function getAdditionValueAttribute($value)
	{
		$sum = 0;
		foreach ($this->items as $item) {
			$sum+= $item->total_addition_value;
		}
		return $sum;
	}


	public function getTaxValueAttribute($value)
	{
		$sum = 0;
		foreach ($this->items as $item) {
			$sum+= $item->total_ipi_value;
		}
		return $sum;
	}


	public function getDeliveryNameAttribute($value)
	{
		if($this->full_delivery == 1){
			return 'Integral';
		} else {
			return 'Parcial';
		}
	}

	public function getDeliveryNameAliasAttribute($value)
	{
		if($this->full_delivery == 1){
			return 'I';
		} else {
			return 'P';
		}
	}



}
