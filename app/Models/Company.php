<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function getData2() {
        // DBからデータ取得
        $companies = Company::all();
        
        return $companies;
    }

    public function product() {
        //productsテーブルとのリレーション
        return $this->hasMany('App\Models\Product');
    }
}
