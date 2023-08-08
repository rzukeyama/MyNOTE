<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集/削除 {{$function->name}} | {{config('app.name')}}</title>
    <link rel="stylesheet" href="/bootstrap.css">
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
            <div class="h1">編集/削除 {{$function->name}}</div>
            <p>

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

    <form method="POST" action="/key_values/{{$key_value->id}}" autocomplete="off">
        @method('PUT')
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="row mt-5">
            <div class="col">
                <input type="text" name="name" class="form-control-lg form-text" placeholder="メモをここに記載" maxlength="100" value="{{$key_value->name}}">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <input type="text" name="key" class="form-control-lg form-text" placeholder="ID" maxlength="100" value="{{$key_value->key}}">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <input type="text" name="value" class="form-control-lg form-text" placeholder="パスワード" maxlength="100" value="{{$key_value->value}}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <input type="submit" class="btn btn-primary" value="保存">
            </div>
        </div>
    </form>

    <form method="POST" action="/key_values/{{$key_value->id}}">
        @method('DELETE')
        @csrf
        <div class="row mt-3">
            <div class="col">
                <input type="submit" class="btn btn-danger" value="削除">
            </div>
        </div>
    </form>

</div>

</body>
</html>
