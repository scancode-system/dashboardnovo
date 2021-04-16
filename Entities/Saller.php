<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SallerFactory;

class Saller extends Model
{
  use HasFactory;

  protected $fillable = ['id', 'name', 'email', 'password', 'goal', 'login'];

  /**
   * Create a new factory instance for the model.
   *
   * @return \Illuminate\Database\Eloquent\Factories\Factory
   */
  protected static function newFactory()
  {
    return SallerFactory::new();
  }

  /**Repository */
  protected static function search($search, $limit = 10)
  {
    $saller =  Saller::where('name', 'like', '%' . $search . '%')->paginate($limit);
    $saller->appends(request()->query());
    return $saller;
  }

  protected static function loadByUniqueKeys($id, $login, $email)
  {
    return Saller::where('id', $id)->orWhere('login', $login)->orWhere('email', $email)->first();
  }
}
