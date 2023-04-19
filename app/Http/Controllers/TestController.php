<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Applications\MAMP\Htdocs\Test\Resources\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

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

        $search = new Product;
        $products = $search->search($keyword, $company_id);
       
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
        $model = new Product();
        $model->name = $request->input(["name"]);
        $model->price = $request->input(["price"]);
        $model->stock = $request->input(["stock"]);
        $model->comment = $request->input(["comment"]);
        $model->company_id = $request->input(["company_id"]);
     //画像の保存
        $file_name = $request->file('image')->getClientOriginalName();
        if (!empty($file_name)) {
            $request->file('image')->storeAs('/public', $file_name);
            $model->image ='storage/' . $file_name;
        }
        $model->save();
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
    public function destroy($id)
    {
        //レコードの削除
        $products2 = Product::find($id);
        $products2->delete();

        return redirect(route('list'));
    }
}
