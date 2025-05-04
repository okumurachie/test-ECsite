<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test-ECsite</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        @if (Auth::check())
        <p class="user_name">{{ Auth::user()->name}}様</p>
        @endif
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    ECsite
                </a>
                <nav>
                    <ul class="header-nav">
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                        @else
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/login">ログイン</a>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/register">会員登録</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="register__alert">
            @if(session('message'))
            <div class="register__alert--success">
                {{session('message')}}
            </div>
            @endif
            @if($errors->any())
            <div class="register__alert--danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @yield('content')
    </main>
    <footer class="footer">
        <div class="footer__inner">
            <small class="small">&copy; 2026, inc.</small>
            @if (Auth::check())
            <ul class="footer-nav">
                <li class="footer-nav__item">
                    <a href="/" class="footer-nav__link">ホームに戻る</a>
                </li>
                <li class="footer-nav__item">
                    <a href="/admin/register" class="footer-nav__link">管理者メニューはこちら</a>
                </li>
            </ul>
            @endif
        </div>
    </footer>
</body>

</html>