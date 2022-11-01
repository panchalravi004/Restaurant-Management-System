<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getSubCategory()
    {
        return $this->hasMany('App\Models\SubCategory','id','sub_category_id');
    }
}
