@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="cart__content">
    <h1 class="cart_list">カートリスト</h1>
    @if (count($cart)>0)
    @php
    $total =0;
    @endphp
    <table class="cart_item">
        <tr class="table_header">
            <th>商品名</th>
            <th>価格</th>
            <th>数量</th>
            <th>小計</th>
            <th>操作</th>
        </tr>
        @foreach($cart as $id => $item)
        @php
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        @endphp
        <tr class="table_inner">
            <td>{{ $item['name'] }}</td>
            <td>¥{{ number_format($item['price']) }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>¥{{ number_format($subtotal) }}</td>
            <td>
                <form method="POST" action="{{ route('cart.remove', $id) }}">
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="total_price">
        合計金額：¥{{number_format($total)}}
    </div>

    <div class="continue-shopping">
        <a href="/" class="back-to-index">
            <button type="submit">買い物を続ける</button>
        </a>
        <a href="{{ route('purchase.form') }}" class="shopping_complete">
            <button type=submit>購入手続きへ進む</button>
        </a>

    </div>
    <div class="purchase">

    </div>
    @else
    <P class="no-item">カートに商品はありません</P>
    @endif
</div>
@endsection