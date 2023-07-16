<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>利用者名設定/変更 | {{config('app.name')}}</title>
    <link rel="stylesheet" href="/bootstrap.css">
</head>
<body>

<div class="container">

    <div class="row mt-2">
        <div class="col">
            <div class="h1">{{config('app.name')}} 利用者名設定/変更</div>
            <p>
                ここでは、利用者名の設定や変更ができます。
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
<form name="challenge" action="/user/change_name" method="POST">
    @csrf
    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label class="form-label">現在の利用者名</label>
            {{ Auth::user()->name ?? '(未設定)' }}
        </div>
    </div>

    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <label for="name" class="form-label">設定後の利用者名</label>
            <input class="form-control" id="name" type="text" name="display_name" placeholder="">
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
