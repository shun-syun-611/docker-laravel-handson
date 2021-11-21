@extends('layouts.app')
@section('content')
<div class="w-50 mx-auto p-2">
<h1>input（投稿画面）</h1>
<!-- /saveにPOST送信 -->
<form action="{{route('save')}}" method="post" enctype="multipart/form-data">
<!-- /saveにPOST送信 -->
    @csrf
    <textarea name="content" cols="30" rows="10"></textarea>
    <input type="submit" value="送信">
    <br>
    @error('file')
        {{$message}}
        <br>
    @enderror
    <input type="file" name="file">
</form>
</div>
@endsection