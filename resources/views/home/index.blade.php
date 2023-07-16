<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ホーム | {{config('app.name')}}</title>
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>

<div class="container">

    @if (!is_null(Auth::user()->display_name))
        <div class="row">
            <div class="col">
                ようこそ {{ Auth::user()->display_name }} さん！
            </div>
        </div>
    @endif

    <div class="row mt-2">
        <div class="col">
            <div class="h1">{{config('app.name')}}</div>
            <p>
                {{config('app.name')}}は、あなただけのプライベートノート。あなたに関する記録はなんでもおまかせください！
            </p>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            @foreach ($userFunctions as $func)
            <a href="/{{$func->function->route}}" class="btn btn-info">{{$func->function->name}}</a>
            @endforeach
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <a href="/user/logout" class="btn btn-dark">利用を終了する(ログアウト)</a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <h2>利用者設定</h2>
            <p>
                パスワードの変更やアプリの追加はこちらからどうぞ
            </p>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <a href="/user/change_password" class="btn btn-secondary">パスワードの変更</a>
            <a href="/user/change_name" class="btn btn-secondary">表示名の設定/変更</a>
            <a href="/user_functions" class="btn btn-secondary">機能設定</a>
            <a href="/user/delete" class="btn btn-outline-danger">{{config('app.name')}}をやめる(利用者情報の完全削除)</a>
        </div>
    </div>

</div>

</body>
</html>
