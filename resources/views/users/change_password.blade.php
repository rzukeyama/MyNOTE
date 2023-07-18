<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>利用者パスワード変更 | {{config('app.name')}}</title>
    <link rel="stylesheet" href="/bootstrap.css">
</head>
<body>

<div class="container">

    <div class="row mt-2">
        <div class="col">
            <div class="h1">{{config('app.name')}} 利用者パスワード変更</div>
            <p>
                ここでは、利用者パスワードの変更ができます。
            </p>
            <ul>
                <li>パスワードは8文字以上で設定しなければなりません</li>
                <li>忘れにくく、推測されにくいパスワードをおすすめします</li>
            </ul>
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
<form name="challenge" action="/user/change_password" method="POST" autocomplete="off">
    @csrf
    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label class="form-label">Eメールアドレス</label>
            {{ Auth::user()->email }}
        </div>
    </div>

    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label for="password" class="form-label">変更後のパスワード</label>
            <input class="form-control" id="password" type="password" name="password" placeholder="">
        </div>
    </div>

    <div class="row mt-5 d-grid gap-2">
        <div class="col-auto">
            <input class="form-control btn btn-primary" type="submit" value="確定">
        </div>
    </div>
</form>

</div>

</body>
</html>
