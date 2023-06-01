<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    public $sortable = [
        'id',
        'image',
        'name',
        'price',
        'stock',
        'company_name',
    ];

    public function getData() {
        // DBからデータ取得
        $products = Product::sortable()->get();
        
        return $products;
    }

    public function search($keyword, $company_id, $max_price, $min_price, $max_stock, $min_stock) {
        //検索フォーム
        $query = Product::sortable();

        if (!empty($keyword)) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        if (!empty($company_id)) {
            $query->where('company_id', $company_id);
        }

        if (!empty($max_stock)) {
            $query->where('stock', '<=', $max_stock);
        }

        if (!empty($min_stock)) {
            $query->where('stock', '>=', $min_stock);
        }

        if (!empty($max_price)) {
            $query->where('price', '<=', $max_price);
        }

        if (!empty($min_price)) {
            $query->where('price', '>=', $min_price);
        }
        return $query->get();
    }

    public function newRecord(Request $request) {
        //新規登録処理
        $model = new Product($request->all());
        
        //画像の保存
        if ($request->hasFile('image')) {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/public', $file_name);
            $model->image ='storage/' . $file_name;
        }
        $model->save();
        return $model;
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

    public function sale() {
        //salesテーブルとのリレーション
        return $this->hasMany('App\Models\Sale');
    }
}
