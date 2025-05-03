@extends('layouts.admin')

@section('title', '管理者ダッシュボード')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboad.css') }}">
@endsection

@section('content')
<div class="admin-dashboard">
    <div class="admin-dashboard__content">
        <h2 class="admin-dashboard__title">管理者ダッシュボード</h2>

        <div class="admin-dashboard__cards">
            <div class="admin-dashboard__card">
                <h3 class="admin-dashboard__card-title">商品管理</h3>
                <div class="admin-dashboard__card-links">
                    <a href="{{ route('admin.item.add') }}" class="admin-dashboard__link">商品を登録</a>
                    <a href="{{ route('admin.item.list') }}" class="admin-dashboard__link">商品を編集</a>
                </div>
            </div>

            <div class="admin-dashboard__card">
                <h3 class="admin-dashboard__card-title"> 注文管理</h3>
                <div class="admin-dashboard__card-links">
                    <a href="{{ route('admin.item.shipping_list')}}" class="admin-dashboard__link">発送待ち一覧</a>
                    <a href="#" class="admin-dashboard__link">売上統計</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection