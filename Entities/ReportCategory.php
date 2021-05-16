<?php

namespace Modules\Dashboard\Entities;

use Modules\Dashboard\Entities\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ReportCategoryFactory::new();
    }

    /**relationship */
    public function reports()
    {
      return $this->hasMany(Report::class);
    }

    /**repository */
    public static function loadByName($name){
        return ReportCategory::where('name', $name)->first();
    }

}
