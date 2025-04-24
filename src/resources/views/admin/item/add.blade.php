@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section('content')
<div class="item_register__content">
    <div class="item_register-form__heading">
        <h2>商品登録</h2>
    </div>
    <form class="item-form" action="/admin/item/add" method="post" enctype="multipart/form-data">
        @csrf
        <div class="item-form__group">
            <div class="item-form__group-title">
                <span class="item-form__label--item">商品名</span>
            </div>
            <div class="item-form__group-content">
                <div class="item-form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}" />
                </div>
                <div class="item-form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="item-form__group">
            <div class="item-form__group-title">
                <span class="item-form__label--item">価格</span>
            </div>
            <div class="item-form__group-content">
                <div class="item-form__input--text">
                    <input type="number" name="price" value="{{ old('price') }}">
                </div>
                <div class="item-form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="item-form__group">
            <div class="item-form__group-title">
                <span class="item-form__label--item">在庫数</span>
            </div>
            <div class="item-form__group-content">
                <div class="item-form__input--text">
                    <input type="number" name="stock" value="{{ old('stock') }}">
                </div>
                <div class="item-form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="item-form__group">
            <div class="item-form__group-title">
                <span class="item-form__label--item">商品画像</span>
            </div>
            <div class="item-form__group-content">
                <input type="file" id="imageInput" accept="image/*" name="image">
                <div class="item-form__img">
                    <img id="preview" alt="image preview" style="max-width: 200px; display: none;">
                </div>
            </div>
        </div>
        <div class="item-form__group">
            <div class="item-form__group-title">
                <span class="item-form__label--item">商品説明</span>
            </div>
            <div class="item-form__group-content">
                <div class="item-form__input--textarea">
                    <textarea name="description" cols="60" rows="5">{{old('description','')}}</textarea>
                </div>
            </div>
        </div>
        <div class="item-form__button">
            <button class="item-form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection