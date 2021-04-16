<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceTable extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\PriceTableFactory::new();
    }

    /* repository */
    public static function loadByName($name){
        return PriceTable::where('name', $name)->first();
    }
}
