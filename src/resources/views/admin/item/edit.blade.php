@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="edit__content">
    <div class="edit-form__heading">
        <h2>商品登録内容編集</h2>
    </div>
    <div class="form_group">
        <form class="edit-item-form" action="{{route('items.update',['id' => $item->id]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="edit-item-form__group">
                <div class="edit-item-form__group-title">
                    <span class="edit-item-form__label--item">出品名</span>
                </div>
                <div class="edit-item-form__group-content">
                    <div class="edit-item-form__input--text">
                        <input type="text" name="name" value="{{$item->name}}" />
                    </div>
                    <div class="edit-item-form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="edit-item-form__group">
                <div class="edit-item-form__group-title">
                    <span class="edit-item-form__label--item">価格</span>
                </div>
                <div class="edit-item-form__group-content">
                    <div class="edit-item-form__input--text">
                        <input type="number" name="price" value="{{$item->price}}">
                    </div>
                    <div class="edit-item-form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="edit-item-form__group">
                <div class="edit-item-form__group-title">
                    <span class="edit-item-form__label--item">現在の在庫数</span>
                </div>
                <div class="edit-item-form__group-content">
                    <div class="edit-item-form__display--text">
                        <p class="display-stock">{{ $item->stock }} 個</p>
                    </div>
                </div>
            </div>
            <div class="edit-item-form__group">
                <div class="edit-item-form__group-title">
                    <span class="edit-item-form__label--item">追加在庫数</span>
                </div>
                <div class="edit-item-form__group-content">
                    <div class="edit-item-form__input--text">
                        <input type="number" name="add_stock" value="0" min="0">
                    </div>
                    <div class="edit-item-form__error">
                        @error('add_stock')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="edit-item-form__group">
                <div class="edit-item-form__group-title">
                    <span class="edit-item-form__label--item">商品説明</span>
                </div>
                <div class="edit-item-form__group-content">
                    <div class="edit-item-form__input--textarea">
                        <textarea name="description" cols="60" rows="5">{{$item->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="edit-item-form__button">
                <button class="edit-item-form__button-submit" type="submit">変更する</button>
            </div>
        </form>
        <form class="edit-item-form" action="{{route('items.imageUpdate', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="edit-item-form__group">
                <div class="edit-item-form__group-title">
                    <span class="edit-item-form__label--item">商品画像</span>
                </div>
                @if ($item->image)
                <div class="current_image">
                    <p class="current_img">現在の画像</p>
                    <img src="{{asset($item->image)}}" alt="商品画像" width="150">
                </div>
                @endif
                <div class="edit-item-form__group-content">
                    <label for="image">画像を更新する場合はこちら：</label><br>
                    <input type="file" id="imageInput" accept="image/*" name="image">
                    <!-- <input type="hidden" name="current_image" value="{{ $item->image }}"> -->
                </div>
                <div class="edit-item-form__button">
                    <button class="edit-item-form__button-submit" type="submit">画像を変更する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection