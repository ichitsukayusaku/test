<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getData() {
        // DBからデータ取得
        $products = Product::all();
        
        return $products;
    }

    public function search($keyword, $company_id) {
        //検索フォーム
        $query = Product::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        if (!empty($company_id)) {
            $query->where('company_id', $company_id);
        }

        return $query->get();
    }
    //レコード編集
    protected $fillable = [
        'name',
        'company_id',
        'price',
        'stock',
        'comment',
    ];

    public function recordUpdate($id, $data) {
        
        $product = $this->find($id);
        $product->fill($data);
        $product->save();

        return $product;
    }

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }     
}
