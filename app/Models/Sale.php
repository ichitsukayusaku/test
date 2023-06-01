<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Sale extends Model
{
    protected $fillable = ['product_id'];

    public function createSale($product_id) {
        return $this->create([
            'product_id' => $product_id,
        ]);
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}