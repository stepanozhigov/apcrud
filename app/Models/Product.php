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

    //oneToMany
    public function ordered_products() {
        return $this->hasMany(OrderedProduct::class);
    }
}
