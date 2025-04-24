<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>

<body>
    <header class="admin-header">
        <div class="admin-header__inner">
            <h1 class="admin-header__title">管理者画面</h1>
            @auth
            <nav class="admin-nav">
                <ul class="admin-nav__list">
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.dashboard') }}" class="admin-nav__link">ダッシュボード</a>
                    </li>
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.item.add') }}" class="admin-nav__link">商品追加</a>
                    </li>
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.item.edit') }}" class="admin-nav__link">商品編集</a>
                    </li>
                    <li class="admin-nav__item">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="admin-nav__link__button">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </nav>
            @endauth
        </div>
    </header>

    <main>
        <div class="admin_register__alert">
            @if(session('message'))
            <div class="admin_register__alert--success">
                {{session('message')}}
            </div>
            @endif
            @if($errors->any())
            <div class="admin_register__alert--danger">
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

    <footer class="admin-footer">
        <div class="admin-footer__inner">
            <small class="small">&copy; 2026, inc.</small>
            <li class="footer-nav__item">
                <a href="/" class="footer-nav__link">ホームに戻る</a>
            </li>
            </ul>
        </div>
    </footer>
</body>

</html>