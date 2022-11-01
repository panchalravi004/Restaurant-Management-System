<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public function getItems()
    {
        return $this->hasMany('App\Models\TableOrder','table_id','id');
    }
}
