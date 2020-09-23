<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder; // ★ この行を追記！
use App\Http\Requests\CreateFolder; // ★ 追加
use Illuminate\Support\Facades\Auth;
use App\User; 

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {

    $user = User::first();
    // 最初のレコードを取得

    // フォルダモデルのインスタンスを作成する
    $folder = new Folder();
    // タイトルに入力値を代入する
    $folder->title = $request->title;
    $folder->user_id = $user->id;
    // インスタンスの状態をデータベースに書き込む
    $folder->save();

    // Auth::user()->folders()->save($folder);

    return redirect()->route('tasks.index', [
        'id' => $folder->id,
    ]);

    }
}