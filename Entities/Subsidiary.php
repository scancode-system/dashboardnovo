<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subsidiary extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\SubsidiaryFactory::new();
    }

    /**repository */
    public static function loadByName($name){
        return Subsidiary::where('name', $name)->first();
    }

}
