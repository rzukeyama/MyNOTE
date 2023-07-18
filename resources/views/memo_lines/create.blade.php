<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>追加 {{$function->name}} | {{config('app.name')}}</title>
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
            <div class="h1">追加 {{$function->name}}</div>
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

    <form method="POST" action="/memo_lines" autocomplete="off">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="row mt-5">
            <div class="col">
                <input type="text" name="memo" class="form-control-lg form-text" placeholder="メモをここに記載" maxlength="100">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <input type="submit" class="btn btn-primary" value="保存">
            </div>
        </div>
    </form>

</div>

</body>
</html>
