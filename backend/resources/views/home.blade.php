@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('掲示板') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('ログインしました！') }} -->
                    <a href="{{route('output')}}">タイムタインを見る</a><br>
                    <a href="{{route('input')}}">投稿する</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
