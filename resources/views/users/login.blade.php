<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>利用者認証 | {{config('app.name')}}</title>
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>

<div class="container">

    <div class="row mt-2">
        <div class="col">
            <div class="h1">{{config('app.name')}} 利用者認証</div>
            <p>
                {{config('app.name')}}のご利用には、利用者認証が必要です。登録したEメールアドレスとパスワードを入力して認証してください。
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
<form name="challenge" action="/login" method="POST" autocomplete="off">
    @csrf
    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label for="email" class="form-label">Eメールアドレス</label>
            <input class="form-control" type="text" id="email" name="email" placeholder="taro@gmail.com">
        </div>
    </div>

    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label for="password" class="form-label">パスワード</label>
            <input class="form-control" id="password" type="password" name="password" placeholder="">
        </div>
    </div>

    <div class="row mt-5 d-grid gap-2">
        <div class="col-auto">
            <input class="form-control btn btn-primary" type="submit" value="認証">
        </div>
    </div>
</form>
    <div class="row mt-2">
        <div class="col">
            まだ利用者登録のお済みでない方は
            <a href="/create_user">こちらから利用者登録してください</a>
        </div>
    </div>

</div>

</body>
</html>
