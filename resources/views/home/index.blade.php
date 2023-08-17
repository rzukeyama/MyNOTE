@extends('layouts.main')
@section('pageTitle', 'ホーム')
@section('js')
@endsection

@section('contents')
    <div class="container">

        <div class="row mt-2">
            <div class="col">
                @if (session('error'))
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-octagon"></i> {{ session('error') }}
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

        @if (!is_null(Auth::user()->display_name))
            <div class="row mt-2">
                <div class="col">
                    ようこそ {{ Auth::user()->display_name }} さん！
                </div>
            </div>
        @endif

        @if (\App\Models\UserFunction::isEnableFunction(Auth::user()->id, 1))
        <form method="POST" action="/memo_lines" autocomplete="off">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="row mt-2">
                <div class="h2">メモを追加</div>
            </div>
            <div class="row">
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
        @endif

    </div>
@endsection
