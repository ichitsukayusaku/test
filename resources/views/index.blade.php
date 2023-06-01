@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}" class="rel">
    <script src="{{ asset('/js/index.js') }}"></script>
</head>
<body>
    <div class="form">
        <h4 class="search">検索フォーム</h4>
        <div class="search__name">
            <form id="search__form" method="GET">
                @csrf
                <input type="text" name="keyword" id="keyword" placeholder="商品名を入力">
                <select class="search__select" name="company_id" id="company_id">
                    <option value="" hidden selected>選択してください</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                <input type="text" name="max_price" id="max_price" placeholder="価格の上限を入力">
                <input type="text" name="min_price" id="min_price" placeholder="価格の下限を入力">
                <input type="text" name="max_stock" id="max_stock" placeholder="在庫の上限を入力">
                <input type="text" name="min_stock" id="min_stock" placeholder="在庫の下限を入力">
                <button class="search__btn">検索</button>
            </form>
        </div>
    </div>
    <div class="register">
        <button class="btn__create" onclick="location.href='home/create'">新規登録</button>
    </div>
    <table class="table__list">
        <tr>
            <th>@sortablelink('id', 'No.')</th>
            <th>@sortablelink('image', 'image')</th>
            <th>@sortablelink('name', 'name')</th>
            <th>@sortablelink('price', 'price')</th>
            <th>@sortablelink('stock', 'stock')</th>
            <th>@sortablelink('company_name', 'company')</th>
            <th></th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset($product->image) }}"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}円</td>
            <td>{{ $product->stock }}本</td>
            <td>{{ $product->company->company_name }}</td>
            <td><form action="{{ route('detail', ['id'=>$product->id]) }}" method="GET">
                    @csrf
                    <button class="btn__detail" onclick="location.href='home/detail'">詳細</button>
                </form> 
            </td>
            <td>
                <form data-product-id="{{ $product->id }}" id="delete_btn" method="POST">
                    <button class="btn__destroy" data-delete_btn="{{ $product->id }}">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>    
@endsection
