<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettingPdf extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'margin_top', 'statement_responsibility', 'global_observation'];
    protected $table = 'setting_pdf';
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\SettingPdfFactory::new();
    }

    /* repository */
    public static function get()
    {
        return SettingPdf::first();
    }
}
