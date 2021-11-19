<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Contentクラスを使う
use App\Models\Content;
use App\Models\ContentImage;
use Illuminate\Support\Facades\Storage;

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

        if($request->file('file')) {
            $this->validate($request, [
                'file' => [
                    // 空でない
                    'required',
                    // アップロードされたファイルか
                    'file',
                    // 画像ファイルか
                    'image',
                    // 画像のタイプ
                    'mimes:jpeg,png',
                ]
                ]);
                if($request->file('file')->isValid([])) {
                    $file_name = $request->file('file')->getClientOriginalName();
                    $file_path = Storage::putFile('/images', $request->file('file'), 'public');

                    $image_info = new ContentImage();
                    $image_info->content_id = $input_content->id;
                    $image_info->file_name = $file_name;
                    $image_info->file_path = $file_path;
                    $image_info->save();
                }
        }

        return redirect(route('output'));
    }

    #投稿内容を全表示
    public function output()
    {
        $contents_get_query = Content::select('*');
        $items = $contents_get_query->get();

        foreach ($items as &$item) {
            $file_path = ContentImage::select('file_path')
            ->where('content_id', $item['id'])
            ->first();
            if(isset($file_path)) {
                $item['file_path'] = $file_path['file_path'];
            }
        }

        return view('contents.output', [
            'items' => $items,
        ]);
    }

    #投稿内容の詳細表示
    public function detail($content_id)
    {
        $content_get_query = Content::select('*');
        $item = $content_get_query->find($content_id);

        $file_path = ContentImage::select('file_path')
        ->where('content_id', $item['id'])
        ->first();
        if(isset($file_path)) {
            $item['file_path'] = $file_path['file_path'];
        }

        return view('contents.detail', [
            'item' => $item,
        ]);
    }

    #投稿内容の編集画面を表示
    public function edit($content_id)
    {
        $content_get_query = Content::select('*');
        $item = $content_get_query->find($content_id);

        return view('contents.edit', [
            'item' => $item,
        ]);
    }

    #投稿内容を更新
    public function update(Request $request)
    {
        $content_get_query = Content::select('*');
        $content_info = $content_get_query->find($request['id']);
        $content_info->content = $request['content'];
        $content_info->save();
        return redirect(route('output'));
    }

    //投稿を削除
    public function delete(Request $request)
    {
        $contents_delete_query = Content::select('*');
        $contents_delete_query->find($request['id']);
        $contents_delete_query->delete();

        $content_images_delete_query = ContentImage::select('*');
        if ($content_images_delete_query->find($request['id'] !== [])) {
            $content_images_delete_query->delete();
        }

        return redirect(route('output'));
    }
}
