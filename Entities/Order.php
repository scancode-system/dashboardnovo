<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\OrderFactory::new();
    }

    /**Repository */
    protected static function search($search, $limit = 10) {
		$orders =  Order::where('id', $search)->
		orWhereHas('client', function($query) use ($search) {
			$query->where('corporate_name', 'like', '%'.$search.'%');
		})->
		orWhereHas('saller', function($query) use ($search) {
			$query->where('name', 'like', '%'.$search.'%');
		})->
		orWhereHas('status', function($query) use ($search) {
			$query->where('name', 'like', '%'.$search.'%');
		})->
		with(['client', 'client.address', 'saller', 'payment', 'items'])->
		paginate($limit);

		$orders->appends(request()->query());
		return $orders;
    }
}
