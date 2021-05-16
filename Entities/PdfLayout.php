<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PdfLayout extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'path', 'selected'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\PdfLayoutFactory::new();
    }

    /**repository */
    public static function select(PdfLayout $pdf_layout_selected){
		$pdf_layouts = PdfLayout::all();
		foreach ($pdf_layouts as $pdf_layout) {
			$pdf_layout->update(['selected' => false]);
		}
		$pdf_layout_selected->update(['selected' => true]);
    }
    
    public static function loadView(){
		return PdfLayout::where('selected', true)->first()->path;
	}
}