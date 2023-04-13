@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}" class="rel">
</head>
<body>
    <h4 class="search">検索フォーム</h4>
    <div class="search__name">
        <form action="{{ route('list') }}" method="GET">
            @csrf
            <input type="text" name="keyword" size="30" placeholder="商品名を入力">
            <select class="search__select" name='company_id'>
                @foreach ($companies as $company)
                <option value="" selected hidden>選択してください</option>
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            <input type="submit" value="検索">
        </form>
    </div>
    <div class="register">
        <button class="btn__create" onclick="location.href='home/create'">新規登録</button>
    </div>
    <table class="table__list">
        <tr>
            <th>No.</th>
            <th>image</th>
            <th>name</th>
            <th>price</th>
            <th>stock</th>
            <th>company</th>
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
            <td><form action="{{ route('detail', ['id'=>$product->id]) }}"method="GET">
                    @csrf
                    <button class="btn__detail" onclick="location.href='home/detail'">詳細</button>
                </form> 
            </td>
            <td>
                <form action="{{ route('destroy', ['id'=>$product->id]) }}" onclick="return confirm('削除してもよろしいですか？');" method="POST">
                    @csrf
                    <button class="btn__destroy">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>    
@endsection
