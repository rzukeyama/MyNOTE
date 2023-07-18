<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>利用者登録 | {{config('app.name')}}</title>
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>

<div class="container">

    <div class="row mt-2">
        <div class="col">
            <div class="h1">{{config('app.name')}} 利用者登録</div>
            <p>
                {{config('app.name')}}の利用者登録がお済みでない方は、こちらから登録を行うことができます。
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
                {{ session('error') }}
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
<form name="challenge" action="/create_user" method="POST" autocomplete="off">
    @csrf
    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label for="email" class="form-label">Eメールアドレス<small>　※受信可能なアドレス</small></label>
            <input class="form-control" type="text" id="email" name="email" placeholder="taro@gmail.com">
        </div>
    </div>

    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label for="password" class="form-label">パスワード<small>　※8文字以上の英数字を設定してください</small></label>
            <input class="form-control" id="password" type="password" name="password" placeholder="">
        </div>
    </div>

    <div class="row mt-5 d-grid gap-2">
        <div class="col-auto">
            <input class="form-control btn btn-primary" type="submit" value="登録する">
        </div>
    </div>
</form>
    <div class="row mt-2">
        <div class="col">
            既に利用者登録がお済みの方は
            <a href="/login">こちらから利用者認証を行ってください</a>
        </div>
    </div>

</div>

</body>
</html>
