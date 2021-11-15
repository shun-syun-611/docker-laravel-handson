<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Contentクラスを使う
use App\Models\Content;

class ContentController extends Controller
{
    #投稿入力画面を表示
    public function input()
    {
    return view('contents.input');
    }

    #投稿入力内容を保存
    public function save(Request $request)
    {
        $input_content = new Content();
        $input_content->content = $request['content'];
        $input_content->save();

        return redirect(route('output'));
    }

    #投稿内容を全表示
    public function output()
    {
        $contents_get_query = Content::select('*');
        $items = $contents_get_query->get();

        return view('contents.output', [
            'items' => $items,
        ]);
    }
}
