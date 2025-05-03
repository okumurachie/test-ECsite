@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/delete.css') }}">
@endsection

@section('content')
<div class="delete__content">
    <div class="delete-form__heading">
        <h2>商品取消</h2>
    </div>
    <div class="delete-item__group">
        <div class="delete-item__group-title">
            <span class="delete-item__label--item">商品名</span>
        </div>
        <div class="delete-item__group-content">
            <div class="delete-item-name">{{$item->name}}</div>
        </div>
    </div>
    <div class="delete-item__group">
        <div class="delete-item__group-title">
            <span class="delete-item__label--item">価格</span>
        </div>
        <div class="delete-item-price">¥{{number_format($item->price)}}</div>
    </div>
    <div class="delete-item__group">
        <div class="delete-item__group-title">
            <span class="delete-item__label--item">在庫数</span>
        </div>
        <div class="delete-item-price">{{number_format($item->stock)}}</div>
    </div>
    <div class="delete-item-form__group">
        <div class="delete-item__group-title">
            <span class="delete-item__label--item">商品画像</span>
        </div>
        @if ($item->image)
        <div class="current_image">
            <img src="{{asset($item->image)}}" alt="商品画像" width="150">
        </div>
        @endif
    </div>
    <div class="delete-item__group">
        <div class="delete-item__group-title">
            <span class="delete-item__label--item">商品説明</span>
        </div>
        <div class="delete-item__group-content">
            <div class="delete-item-description">{{$item->description}}</div>
        </div>
    </div>
    <form class="delete-item-form" action="{{route('items.softDelete', ['id' => $item->id ])}}" method="post">
        @csrf
        <div class="delete-item-form__button">
            <button class="delete-item-form__button-submit" type="submit">出品を取り消す</button>
        </div>
    </form>
</div>
@endsection