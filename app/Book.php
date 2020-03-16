<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'price'];

    public function getPriceEuroAttribute()
    {
    	return (new CurrencyServise())->convert($this->price, 'usd', 'eur');
    }
}
