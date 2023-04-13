@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('/css/detail.css') }}" class="rel">
</head>
<body>
    <h4 class="header__detail">商品情報詳細</h4>
    <table class="table__list">
        <tr>
            <th>No.</th>
            <th>image</th>
            <th>name</th>
            <th>price</th>
            <th>stock</th>
            <th>company</th>
            <th>comment</th>
            <th></th>
        </tr>
        <tr>
            <td>{{ $items->id }}</td>
            <td><img src="{{ asset($items->image) }}"></td>
            <td>{{ $items->name }}</td>
            <td>{{ $items->price }}円</td>
            <td>{{ $items->stock }}本</td>
            <td>{{ $items->company->company_name }}</td>
            <td>{{ $items->comment }}</td>
            <td>
                <form action="{{ route('edit', ['id'=>$items->id]) }}"method="GET">
                    @csrf
                    <button class="btn__edit" onclick="location.href='home/detail/edit{id}'">編集</button>
                </form>
            </td>
        </tr>
    </table>
    <button class="returnbtn" onclick="location.href='/test/public/home'">戻る</button>
</body>
@endsection
