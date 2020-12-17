<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name','price'
    ];

    public function getPriceAttribute($val)
    {
        return $val/100;
    }

    public function setPriceAttribute($val)
    {
        $this->attributes['price'] =  $val*100;
    }

    public function ordered_products() {
        return $this->hasMany(OrderedProduct::class);
    }
}
