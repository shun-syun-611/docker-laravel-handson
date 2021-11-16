@extends('layouts.app')
@section('content')
<div class="w-50 mx-auto p-2">
<h1>output（一覧表示）</h1>
@foreach ($items as $item)
    <hr>
    <p>{{$item['content']}}</p>
    <a class="text-right d-block"  href="{{route('detail', ['content_id' => $item['id']])}}">詳細</a>
@endforeach
</div>
@endsection