@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('/css/edit.css') }}" class="rel">
</head>
<body>
    <h4 class="header__2">商品情報編集</h4>
    <form action="{{ route('update', ['id'=>$items2->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="register__form">
            <div class="form__group3">
                商品ID:{{ $items2->id }}
            </div>
            <div class="form__group">
                商品名:<input type="text" name="name" class="form__control" size="30" placeholder="{{ $items2->name }}">
                @error('name')
                <span>２０文字以内で入力してください</span>
                @enderror
            </div>
            <div class="form__group">
                会社名:<select name="company_id" class="form__control2">
                    <option value="" selected hidden>{{ $items2->company->company_name }}</option>
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__group">
                値段:<input type="text" name="price" class="form__control3" size="30" placeholder="{{ $items2->price }}">
                @error('price')
                <span>整数で入力してください</span>
                @enderror
            </div>
            <div class="form__group">
                在庫数:<input type="text" name="stock" class="form__control" size="30" placeholder="{{ $items2->stock }}">
                @error('stock')
                <span>整数で入力してください</span>
                @enderror
            </div>
            <div class="form__group2">
                コメント:<textarea name="comment" cols="33" rows="3" placeholder="{{ $items2->comment }}"></textarea>
            </div>
            <div class="form__group">
                イメージ写真:<input type="file" name="image" placeholder="{{ $items2->image }}">
            </div>
            <div class="register__btn">
                <button class="btn-default">更新</button>
            </div>
        </div>     
    </form>
    <form action="{{ route('detail', ['id'=>$items2->id]) }}"method="GET">
        @csrf
        <button class="return__edit" onclick="location.href='/home/detail/{id}'">戻る</button>
    </form>    
</body>
@endsection
