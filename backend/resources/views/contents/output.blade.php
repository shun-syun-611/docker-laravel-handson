<h1>output（一覧表示）</h1>

@foreach ($items as $item)
    <hr>
    <p>{{$item['content']}}</p>
@endforeach