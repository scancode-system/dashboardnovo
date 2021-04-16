<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'qty_now', 'date_now', 'qty_future', 'date_future'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ProductStockFactory::new();
    }

    /**repository */
    public function updateDates($date_now, $date_future){
        $this->date_now = $date_now;
        $this->date_future = $date_future;
        $this->save();
    }

    public function put($qty_now, $qty_future){
        $this->qty_now = $qty_now;
        $this->qty_future = $qty_future;
        $this->save();
    }

}
