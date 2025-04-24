@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin_login-form__content">
    <div class="admin_login-form__heading">
        <h2>ログイン</h2>
    </div>
    <form class="admin_login_form" action="/admin/login" method="post">
        @csrf
        <div class="admin_login_form__group">
            <div class="admin_login_form__group-title">
                <span class="admin_login_form__label--item">メールアドレス</span>
            </div>
            <div class="admin_login_form__group-content">
                <div class="admin_login_form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" />
                </div>
                <div class="admin_login_form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="admin_login_form__group">
            <div class="admin_login_form__group-title">
                <span class="admin_login_form__label--item">パスワード</span>
            </div>
            <div class="admin_login_form__group-content">
                <div class="admin_login_form__input--text">
                    <input type="password" name="password" />
                </div>
                <div class="admin_login_form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="admin_login_form__button">
            <button class="admin_login_form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
    <div class="admin_register__link">
        <a class="admin_register__button-submit" href="/admin/register">管理者登録の方はこちら</a>
    </div>
</div>
@endsection