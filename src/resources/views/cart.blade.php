@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="cart__content">
    @if (session('message'))
    <div>{{ session('message') }}</div>
    @endif
    <h1 class="cart_list">カートリスト</h1>
    @if (count($cart)>0)
    <table class="cart_item">
        <tr class="table_header">
            <th>商品名</th>
            <th>価格</th>
            <th>数量</th>
            <th>小計</th>
            <th>操作</th>
        </tr>
        @foreach($cart as $id => $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>¥{{ number_format($item['price']) }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>¥{{ number_format($item['price'] * $item['quantity']) }}</td>
            <td>
                <form method="POST" action="{{ route('cart.remove', $id) }}">
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <P class="no-item">カートに商品はありません</P>
    @endif
</div>
@endsection