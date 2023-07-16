<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>機能設定 | {{config('app.name')}}</title>
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
            <div class="h1">{{config('app.name')}} 機能設定</div>
            <p>
                ここでは、あなたが{{config('app.name')}}で使用できる機能のカスタマイズを行うことができます。数ある機能の中から、あなたが使うものだけを選ぶことができます。
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

    <div class="row mt-5">
        <div class="col">
            <h2>現在使用中の機能</h2>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            @if ($userFunctions->count())
            <table class="table">
                @foreach ($userFunctions as $func)
                    <tr>
                        <td>{{ $func->name }}</td>
                    </tr>
                @endforeach
            </table>
            @else
            <p>まだ使用中の機能はありません</p>
            @endif
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <h2>使用する機能を選択</h2>
        </div>
    </div>

    <form method="POST" action="/user_functions">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="row mt-5">
            <div class="col">
                <select class="form-select form-select-lg" name="function_id">
                    <option selected>次の中から選択してください</option>
                    @foreach ($functions as $func)
                        <option value="{{ $func->id }}">{{ $func->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <input type="submit" class="btn btn-primary" value="選択した機能を追加する">
            </div>
        </div>
    </form>

</div>

</body>
</html>
