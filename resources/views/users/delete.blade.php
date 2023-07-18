<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>利用をやめる | {{config('app.name')}}</title>
    <link rel="stylesheet" href="/bootstrap.css">
</head>
<body>

<div class="container">

    <div class="row mt-2">
        <div class="col">
            <div class="h1">{{config('app.name')}} 利用停止手続き</div>
            <p>
                利用停止を行いますと、{{config('app.name')}}からあなたの登録情報がすべて削除され、利用できなくなります。よろしいですか？
            </p>
            <ul>
                <li>一度削除されると、お問い合わせされても元に戻すことができません</li>
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
<form action="/user/delete" method="POST" autocomplete="off">
    @csrf
    <div class="row mt-2 d-grid gap-2">
        <div class="col-auto">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="delete">
                <label class="form-check-label">削除する</label>
            </div>
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
