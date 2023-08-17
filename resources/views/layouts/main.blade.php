<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle') | {{config('app.name')}}</title>
    <link rel="stylesheet" href="/sample.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            機能
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($userFunctions as $func)
                                <li><a class="dropdown-item" href="/{{$func->function->route}}">{{$func->function->name}}</a></li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="/user_functions" class="dropdown-item">機能設定</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->display_name ?? 'ユーザー' }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="/user/change_password" class="dropdown-item">パスワードの変更</a></li>
                            <li><a href="/user/change_name" class="dropdown-item">表示名の設定/変更</a></li>
                            <li><a href="/user/delete" class="dropdown-item text-danger">{{config('app.name')}}をやめる(利用者情報の完全削除)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="/user/logout" class="dropdown-item">利用を終了する(ログアウト)</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@yield('contents')
<script src="/js/bootstrap.min.js"></script>
@yield('js')
</body>
</html>
