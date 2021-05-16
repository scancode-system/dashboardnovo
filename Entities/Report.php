<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\ReportCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['module', 'export', 'alias', 'report_category_id'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ReportFactory::new();
    }

    /**relationship */
    public function report_category()
    {
      return $this->belongsTo(ReportCategory::class);
    }

    /**mutators */
    public function getExportClassAttribute()
    {
        return 'Modules\\'.$this->module.'\\Exports\\'.$this->export;
    }

    public function getFileAliasAttribute()
    {
        return $this->alias.'.xlsx';
    }

    /**repository */
    public static function createByCategory($data, $report_category_name){
        $report_category = ReportCategory::loadByName($report_category_name);
        if(!$report_category){
            $report_category = ReportCategory::create(['name' => $report_category_name]);
        }
        return Report::create($data+['report_category_id' => $report_category->id]);
    }

    public static function deleteByAlias($alias){
        $report = Report::where('alias', $alias)->first();
        if($report){
            $report->delete();
        }
    }

}