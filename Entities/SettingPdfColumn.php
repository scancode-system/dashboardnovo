<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettingPdfColumn extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alias', 'show'];

    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\SettingPdfColumnFactory::new();
    }

    /**repository */
    public static function updateById($id, $data){
        (SettingPdfColumn::find($id))->update($data);
    }

    public static function countShowColumns()
	{
		return SettingPdfColumn::where('show', true)->count();
	}

	public static function countHideColumns()
	{
		return SettingPdfColumn::where('show', false)->count();
	}

}