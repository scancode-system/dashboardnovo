<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Entities\Shipping;
use Modules\Dashboard\Entities\PriceTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'corporate_name', 'fantasy_name', 'cpf_cnpj', 'buyer', 'email', 'phone', 'street', 'number', 'apartment', 'neighborhood', 'city', 'st', 'postcode', 'shipping_id', 'price_table_id'];

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ClientFactory::new();
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function price_table()
    {
        return $this->belongsTo(PriceTable::class);
    }


    /**Repository */
    protected static function search($search, $limit = 10)
    {
        $clients =  Client::where('id', $search)
            ->orWhere('corporate_name', 'like', '%' . $search . '%')
            ->orWhere('fantasy_name', 'like', '%' . $search . '%')
            ->orWhere('cpf_cnpj', $search)
            ->orWhere('buyer', 'like', '%' . $search . '%')
            ->paginate($limit);

        $clients->appends(request()->query());
        return $clients;
    }

    public static function loadByUniqueKeys($id){
		return Client::where('id', $id)->first();
	}

}
