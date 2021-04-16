<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\PaymentFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'description', 'min_value', 'discount', 'addition', 'visible'];

    protected static function newFactory()
    {
        return PaymentFactory::new();
    }

    /**Repository */
    protected static function search($search, $limit = 10)
    {
		$payments =  Payment::where('description', 'like', '%'.$search.'%')->paginate($limit);
		$payments->appends(request()->query());
		return $payments;
    }

    public static function loadByUniqueKeys($id, $description)
    {
      return Payment::where('id', $id)->orWhere('description', $description)->first();
    }

}
