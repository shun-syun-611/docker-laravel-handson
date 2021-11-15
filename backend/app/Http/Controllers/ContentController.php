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

        return redirect(route('input'));
    }
}
