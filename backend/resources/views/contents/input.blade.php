@extends('layouts.app')
@section('content')
<h1>input（投稿画面）</h1>
<!-- /saveにPOST送信 -->
<form action="{{route('save')}}" method="post">
<!-- /saveにPOST送信 -->
    @csrf
    <textarea name="content" cols="30" rows="10"></textarea>
    <input type="submit" value="送信">
</form>
@endsection