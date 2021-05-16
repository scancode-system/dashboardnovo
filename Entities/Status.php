<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\StatusFactory::new();
    }

    const OPEN = 1;
	const COMPLETED = 2;
	const CANCELED = 3;
	const RESERVED = 4;

	public function getColorAttribute($value)
	{
		$color = '';
		switch ($this->id) {
			case self::OPEN:
			$color =  'success';
			break;
			case self::COMPLETED:
			$color = 'primary';
			break;
			case self::CANCELED:
			$color = 'danger';
			break;
			case self::RESERVED:
			$color = 'info';
			break;			
			default:
			break;
		}

		return $color;
	}
}
