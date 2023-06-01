@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('/css/create.css') }}" class="rel">
</head>
<body>
    <h2 class="header__2">新規登録画面</h2>
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="register__form">
            <div class="form__group">
                商品名:<input type="text" name="name" class="form__control" size="30" placeholder="商品名">
                @error('name')
                <span>２０文字以内で入力してください</span>
                @enderror
            </div>
            <div class="form__group">
                会社名:<select name="company_id" class="form__control">
                    <option value="" selected hidden>選択してください</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__group">
                価格:<input type="text" name="price" class="form__control2" size="30"placeholder="価格">
                @error('price')
                <span>整数で入力してください</span>
                @enderror
            </div>
            <div class="form__group">
                在庫数:<input type="text" name="stock" class="form__control" size="30" placeholder="在庫数">
                @error('stock')
                <span>整数で入力してください</span>
                @enderror
            </div>
            <div class="form__group2">
                コメント:<textarea name="comment" cols="33" rows="3" placeholder="コメントを入力"></textarea>
            </div>
            <div class="form__group3">
                イメージ写真:<input type="file" name="image" placeholder="ファイルを選択">
            </div>
            <div class="register__btn">
                <button class="btn-default">登録</button>
            </div>
        </div>     
    </form>    
    <button class="returnbtn" onclick="location.href='/test/public/home'">戻る</button>
</body>
@endsection
