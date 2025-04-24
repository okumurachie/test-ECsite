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
            <!-- @foreach($items as $item) -->
            <a href="/details/{{$item['id']}}" class="content__id">
                <div class="content__box-item">
                    <div class="content__inner">
                        <div class="content__img">
                            <img src="{{asset($item['image'])}}" alt="{{$item['name']}}">
                        </div>
                        <div class="content__detail">
                            <div class="content__detail-1">
                                <div class="content__name">
                                    <p>{{$item['name']}}</p>
                                </div>
                                <div class="content__price">
                                    <p>{{"¥".number_format($item['price'])}}</p>
                                </div>
                            </div>
                            <div class="content__detail-2">
                                <p>{{$item['description']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- @endforeach -->
        </div>
    </div>
</div>
<div class="pagination">
    {{$items->links()}}
</div>
@endsection