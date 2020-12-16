<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number','amount','customer_id'
    ];

    public function ordered_products() {
        return $this->hasMany(OrderedProduct::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
