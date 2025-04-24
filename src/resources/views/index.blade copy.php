@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="ec_content">
    <div class="ec_content__inner">
        <div class="content-header">
            <h2>ファッション・小物類</h2>
        </div>
        <div class="lineup">
            <h3>商品一覧</h3>
        </div>
        <div class="content__box">
            @foreach($products as $product)
            <a href="/details/{{$product['id']}}" class="content__id">
                <div class="content__box-item">
                    <div class="content__inner">
                        <div class="content__img">
                            <img src="{{asset($product['image'])}}" alt="{{$product['name']}}">
                        </div>
                        <div class="content__detail">
                            <div class="content__detail-1">
                                <div class="content__name">
                                    <p>{{$product['name']}}</p>
                                </div>
                                <div class="content__price">
                                    <p>{{"¥".number_format($product['price'])}}</p>
                                </div>
                            </div>
                            <!-- @if($product->purchases)
                            <h2 class="sold">SOLD</h2>
                            @endif
                            <div class="content__detail-2">
                                <p>{{$product['comment']}}</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<div class="pagination">
    {{$products->links()}}
</div>
@endsection