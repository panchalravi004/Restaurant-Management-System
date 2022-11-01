<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function getMainCategory()
    {
        // return $this->hasOne('App\Models\MainCategory','id');
        return $this->hasMany('App\Models\MainCategory','id','main_category_id');
    }
}
