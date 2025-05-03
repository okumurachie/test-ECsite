@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shipping_list.css') }}">
@endsection

@section('content')
<div class="shipping-list__content">
    <div class="shipping-list__title">
        <h2>発送待ち注文一覧</h2>
    </div>

    @if($purchases->isEmpty())
    <h2 class="no-list">発送待ちの商品はありません</h2>
    @else
    @foreach($purchases as $purchase)
    <div class="purchase-table">
        <table class="purchase-table__inner">
            <tr class="purchase-table__row">
                <th>ユーザーID</th>
                <th>商品ID</th>
                <th>価格</th>
                <th>数量</th>
                <th>注文受付日</th>
                <th></th>
            </tr>
            <tr class="purchase-table__row">
                <td class="purchase-user_id">{{ $purchase->user_id }}</td>
                <td class="purchase-item_id">{{ $purchase->item_id }}</td>
                <td class="purchase-price">¥{{ number_format($purchase->price) }}</td>
                <td class="purchase-quantity">{{ number_format($purchase->quantity) }}</td>
                <td class="purchase-date">
                    <span class="date"></span>
                    <span class="created_at">{{ \Carbon\Carbon::parse($purchase->created_at)->format('Y年m月d日') }}</span>
                </td>
                <td class="purchase-table__form-shipping">
                    <form action="{{ route('purchase.ship', $purchase->id) }}" method="POST" onsubmit="return confirm('本当に発送しますか？');">
                        @csrf
                        <button class="shipping_form_button">発送</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
    @endforeach
    @endif
</div>
@endsection