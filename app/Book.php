<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\CurrencyService;

class Book extends Model
{
    protected $fillable = ['name', 'price'];

    public function getPriceEurAttribute()
    {
 //   	return (new CurrencyService())->convert($this->price, 'usd', 'eur');
    }
}
