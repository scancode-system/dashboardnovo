<?php

namespace Modules\Dashboard\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'qty_now', 'date_now', 'qty_future', 'date_future'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ProductStockFactory::new();
    }

    /**relationship */
    public function product()
    {
      return $this->belongsTo(Product::class);
    }
  

    /**repository */
    public function updateDates($date_now, $date_future){
        $this->date_now = $date_now;
        $this->date_future = $date_future;
        $this->save();
    }

    public function updateStock($qty_now, $qty_future, $sales_on){
        if($sales_on){
            $items = $this->product->items;
            foreach($items as $item){
                if($item->order->status_id == Status::COMPLETED){
                    $qty_now -= $item->item_stock->qty_now;
                    $qty_future -= $item->item_stock->qty_future;    
                }
            }
        } 
        $this->qty_now = $qty_now;
        $this->qty_future = $qty_future;    
        
        $this->save();
    }

    public function take($qty){
        $quantities = collect(['qty_now' => 0, 'qty_future' => 0]);

        $left = $this->qty_now - $qty;
        if($left < 0){
            $quantities['qty_now'] = $this->qty_now;
            $qty = $qty - $this->qty_now;
            $this->qty_now = 0;
            $quantities = $this->takeFuture($qty, $quantities);
        } else {
            $quantities['qty_now'] = $qty;
            $this->qty_now = $left;
        }

        return $quantities;
    }

    private function takeFuture($qty, $quantities){
        $left = $this->qty_future - $qty;
        if($left < 0){
            throw new Exception("Não há estoque para esta quantidade.");
        } else {
            $quantities['qty_future'] = $qty;
            $this->qty_future = $left;
        }
        return $quantities;
    }

    public function put($qty_now, $qty_future){
        $this->qty_now += $qty_now;
        $this->qty_future += $qty_future;
    }


}
