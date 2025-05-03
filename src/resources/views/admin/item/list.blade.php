@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="item-list__content">
    <div class="item-list__title">
        <h2>商品一覧</h2>
    </div>
    <div class="item-table">
        <table class="item-table__inner">
            <tr class="item-table__row">
                <th class="item-table__header-1">商品名</th>
                <th class="item-table__header-2">価格</th>
                <th class="item-table__header-3">在庫数</th>
                <th class="item-table__header-4">商品登録日</th>
                <th class="item-table__header-5">操作</th>
            </tr>
            @foreach($items as $item)
            <tr class="item-table__row">
                <td class="item-name">{{$item['name']}}</td>
                <td class="item-price">¥{{number_format($item['price'])}}</td>
                <td class="item-stock">{{number_format($item['stock'])}}</td>
                <td class="item-date">
                    <span class="created_at">{{$item['created_at']->format('Y年m月d日')}}</span>
                </td>
                <td class="item-table__action">
                    <div class="form_button-edit">
                        <a href="/admin/item/edit/{{$item['id']}}" class="item-edit">
                            <button class="form__button-submit" type="submit">編集</button>
                        </a>
                    </div>
                    <div class="form_button-delete">
                        <a href="/admin/item/delete/{{$item['id']}}" class="item-delete">
                            <button class="form__button-submit" type="submit">削除</button>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endsection