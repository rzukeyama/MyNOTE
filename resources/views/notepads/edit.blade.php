@extends('layouts.main')
@section('pageTitle', "編集/削除 $function->name")
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

        <form method="POST" action="/notepads/{{$notepad->id}}" autocomplete="off">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="row mt-3">
                <div class="col">
                    <textarea rows="10" name="memo" class="form-control-lg form-text" placeholder="メモをここに記載">{{$notepad->memo}}</textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <input type="submit" class="btn btn-primary" value="保存">
                </div>
            </div>
        </form>

        <form method="POST" action="/notepads/{{$notepad->id}}">
            @method('DELETE')
            @csrf
            <div class="row mt-3">
                <div class="col">
                    <input type="submit" class="btn btn-danger" value="削除">
                </div>
            </div>
        </form>

    </div>
@endsection
