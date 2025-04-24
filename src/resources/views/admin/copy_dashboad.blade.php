@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboad.css' )}}">
@endsection

@section('content')
<div class="ec_content">
    <div class="ec_content__inner">
        <div class="content-header">
            <h2>管理者メニュー</h2>
        </div>
        <div class="lineup">
            <a href="/admin/register" class="admin-register">管理者登録</a>
            <a href="/admin/login" class="admin-login">管理者ログイン</a>
        </div>
        <nav>
            <ul class="header-nav">
                @if (Admin::check())
                <li class="admin-nav__item">
                    <a href="/admin/item/add" class="admin_item_add">商品登録</a>
                </li>
                <li class="admin-nav__item">
                    <a class="admin_item_edit" href="/admin/item/edit">商品管理・編集</a>
                </li>
                <li class="admin-nav__item">
                    <form class="form" action="/logout" method="post">
                        @csrf
                        <button class="admin-nav__button">ログアウト</button>
                    </form>
                </li>
                @else
                <li class="admin-nav__item">
                    <a href="/admin/register" class="admin-register">管理者登録</a>
                </li>
                <li class="admin-nav__item">
                    <a href="/admin/login" class="admin-login">管理者ログイン</a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
</div>
@endsection