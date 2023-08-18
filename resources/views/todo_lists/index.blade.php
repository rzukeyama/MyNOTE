@extends('layouts.main')
@section('pageTitle', $function->name)
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
                <div class="h1">{{$function->name}}</div>
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

        <div class="row mt-2">
            <div class="col">
                <a href="/todo_lists/create">新たにメモを書く</a>
            </div>
            <div class="col">
                <a href="/">ホームに戻る</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                @if ($todo_list->count() === 0)
                    <p>まだメモがありません。</p>
                @endif
                <div class="list-group">
                    @foreach ($todo_list as $todo)
                        <a href="/todo_lists/{{$todo->id}}/edit" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$todo->todo}}</h5>
                            </div>
                            <small>{{$todo->created_at}}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection