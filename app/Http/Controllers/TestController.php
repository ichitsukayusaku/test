<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Applications\MAMP\Htdocs\Test\Resources\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Kyslik\ColumnSortable\Sortable;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧表示
    public function index(Request $request)
    {   //全件表示分
        $model = new Product();
        $products = $model->getData();

        //セレクトボックスの選択肢
        $model2 = new Company();
        $companies = $model2->getData2();

        //検索フォーム
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
        $max_price = $request->input('max_price');
        $min_price = $request->input('min_price');
        $max_stock = $request->input('max_stock');
        $min_stock = $request->input('min_stock');

        $search = new Product;
        $products = $search->search($keyword, $company_id, $max_price, $min_price, $max_stock, $min_stock);
        
        return view('index',compact('products','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //新規登録画面表示
    public function create()
    {
        $model3 = new Company();
        $companies = $model3->getData2();
        
        return view('create',compact('companies'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //新規登録バリデーション
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);
    
     //DB新規登録処理
        DB::BeginTransaction();

        try {
            $model4 = new Product;
            $model4->newRecord($request);
            DB::commit();
        } catch(\Exseption $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Responses
     */
    public function show($id)
    {
        //詳細画面への１件表示
        $items = Product::find($id);

        return view('detail',compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */ 
    public function edit($id)
    {
        //詳細編集画面への一件表示
        $items2 = Product::find($id);

        $model3 = new Company();
        $companies = $model3->getData2();
        
        return view('edit',compact('items2','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //レコードの編集
        DB::BeginTransaction();

        try {
            $data = $request->only(['name', 'company_id', 'price', 'stock', 'comment']);
    
            $product = new Product();
            $product->recordUpdate($id, $data);
            DB::commit();
        } catch (\Exseption $e) {
            DB::rollback();
            return back();
        }
        
        return redirect(route('update',['id'=>$id]));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //レコード削除
        DB::BeginTransaction();

        try {
            $product2 = Product::find($request->id);
            $product2->delete();
            DB::commit();
            return response()->json('成功');
        } catch (\Exseption $e) {
            DB::rollback();
            return response()->json('失敗')->back();
        }
    }
}
