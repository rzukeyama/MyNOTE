@extends('layouts.main')
@section('pageTitle', '機能設定')
@section('js')
@endsection
@section('contents')
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
                <a href="{{ url("/user_functions/create") }}">機能を追加する</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h2>現在使用中の機能</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <table class="table">
                    @foreach ($userFunctions as $func)
                        <tr>
                            <td>{{ $func->function->name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h2>すべての機能一覧</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <table class="table">
                    @foreach ($allFunctions as $func)
                        <tr>
                            <td>{{ $func->name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
