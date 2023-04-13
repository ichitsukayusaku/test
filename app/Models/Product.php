<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getData() {
        // DBからデータ取得
        $products = Product::all();
        
        return $products;
    }

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }
}
