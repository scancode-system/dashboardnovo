<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettingOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_start', 'buyer', 'number_copies', 'auto'];
    protected $table = 'setting_order';

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\SettingOrderFactory::new();
    }

    /* repository */
    public static function get()
    {
        return SettingOrder::first();
    }
}

