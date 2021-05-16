<?php

namespace Modules\Dashboard\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemStock extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'qty_now', 'qty_future'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ItemStockFactory::new();
    }

 
    /**repository */
    public function take($qty){
        $quantities = collect(['qty_now' => 0, 'qty_future' => 0]);
        $left = $this->qty_future - $qty;
        if($left < 0){
            $quantities['qty_future'] = $this->qty_future;
            $qty = $qty - $this->qty_future;
            $this->qty_future = 0;
            $quantities = $this->takeNow($qty, $quantities);
        } else {
            $quantities['qty_future'] = $qty;
            $this->qty_future = $left;
        }

        return $quantities;
    }

    private function takeNow($qty, $quantities){
        $left = $this->qty_now - $qty;
        if($left < 0){
            throw new Exception("A quantidade no item deste pedido é menor do que o que se pretende devolver.");
        } else {
            $quantities['qty_now'] = $qty;
            $this->qty_now = $left;
        }
        return $quantities;
    }
    
    public function put($qty_now, $qty_future, $save = false){
        $this->qty_now += $qty_now;
        $this->qty_future += $qty_future;
        if($save){
            $this->save();
        }
    }

}
