@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        {!! Form::open(['route' => 'timeline', 'method' => 'POST']) !!}
            {{ csrf_field() }}
            <div class="row mb-4">

                @guest
                    <div class="mx-auto">
                        <a class="btn btn-primary" href="{{ route('login') }}">ログインして投稿する</a>
                        <a class="btn btn-primary" href="{{ route('register') }}">新規登録して投稿する</a>
                    </div>
                @else
                    {{ Form::text('post', null, ['class' => 'form-control col-9 mr-auto']) }}
                    {{ Form::submit('投稿する', ['class' => 'btn btn-primary col-2']) }}
                @endguest

            </div>
            @if ($errors->has('post'))
                <p class="alert alert-danger">{{ $errors->first('post') }}</p>
            @endif
        {!! Form::close() !!}

        @foreach ($posts as $post)
            <div class="mb-1">
                <strong>{{ $post->name }}</strong> {{ $post->created_at }}
            </div>
            <div class="pl-3">
                {{ $post->post }}
            </div>
            <hr>
        @endforeach
    </div>
@endsection
