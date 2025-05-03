@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase__content">
    <h1 class="purchase_list">購入確認</h1>
    @if (count($cart)>0)
    @php
    $total =0;
    @endphp
    <table class="purchase_item">
        <tr class="table_header">
            <th>商品名</th>
            <th>価格</th>
            <th>数量</th>
            <th>小計</th>
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
        </tr>
        @endforeach
    </table>
    <div class="total_price">
        合計金額：¥{{number_format($total)}}
    </div>
    <div class="purchase_form">
        <form action="{{ route('purchase.process') }}" class="purchase_process" method="POST">
            @csrf
            <div class="payment_method">
                <h2>お支払い方法</h2>
                <div class="select-payment_method">
                    <select name="payment_method">
                        <option value="">選択してください</option>
                        <option value="credit">クレジットカード</option>
                        <option value="convenience">コンビニ払い</option>
                        <option value="cod">代金引換</option>
                    </select>
                </div>
            </div>
            <div class="recipient">
                <h2>配送先</h2>
                <div class="post_code">
                    <label class="post_code_label">郵便番号：</label>
                    <input type="text" class="post_code_input" name="post_code">
                </div>
                <div class="recipient">
                    <label class="recipient_label">住所：</label>
                    <input type="text" class="recipient_input" name="recipient">
                </div>
            </div>
            <div class="form-button">
                <button type=submit>購入を確定する</button>
            </div>
        </form>
        <div class="for-cart">
            <a href="/item/cart" class="back-to-cart">
                <button type="submit">カートに戻る</button>
            </a>
        </div>
        @else
        <P class="no-item">カートに商品はありません</P>
        @endif
    </div>
</div>
@endsection