<h1>output（一覧表示）</h1>

@foreach ($items as $item)
    <hr>
    <p>{{$item['content']}}</p>
    <a href="{{route('detail', ['content_id' => $item['id']])}}">詳細</a>
@endforeach