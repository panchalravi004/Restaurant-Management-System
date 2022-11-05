<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOrder extends Model
{
    use HasFactory;

    public function getProduct()
    {
        return $this->hasMany('App\Models\Product','id','product_id');
    }
}
