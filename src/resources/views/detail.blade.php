@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<dv class="item_content">
    <div class="item_content_card">
        <div class="item_img">
            <img src="{{asset($item['image'])}}" alt="{{$item['name']}}">
        </div>
        <div class="about-item">
            <div class="item_information">
                <div class="item_name">
                    <h2>{{$item['name']}}</h2>
                </div>
                <div class="item_price">
                    <p>{{"¥" . number_format($item['price'])}}</p>
                </div>
                <div class="item_description">
                    <p>{{$item['description']}}</p>
                </div>
            </div>
            <div class="item_for-cart">
                <form action="{{route('cart.add',$item['id'])}}" class="for-cart" method="POST">
                    @csrf
                    <label for="quantity" class="item_quantity">購入個数:</label>
                    <input class="item_quantity_input" type="number" name="quantity" value="1" min="1" required>
                    <div class="form_button">
                        <div class="form_button">
                            <button class="form__button-submit" type="submit">カートへ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</dv>
@endsection