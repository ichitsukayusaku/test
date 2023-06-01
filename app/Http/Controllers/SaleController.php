<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Http\Request;
use Applications\MAMP\Htdocs\Test\Resources\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Kyslik\ColumnSortable\Sortable;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Salesテーブルへのレコード追加処理
        $sale = new Sale();
        $productId = $request->input('product_id');
        $sale2 = $sale->createSale($productId);

        //減算処理
        DB::beginTransaction();
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');
    
            $product = Product::find($productId);
            if ($product->stock > 0) {
                $product->decrement('stock');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
