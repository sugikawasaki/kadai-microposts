<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller; 

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {            // ログインしているか？の判断
            $user = \Auth::user();      //$user にログインしている一人のユーザー情報を入れる
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10); //orderby 引数フィールド名、asc=昇順またはdesc降順　→作成日の新しい順に並べる
            
            //$data　としログインしているユーザー、ログインしているユーザーのマククロポスト群を格納
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }    
            return view('welcome', $data); //welcomeファイルを、$dataを代入して、返す
    }
    public function store(Request $request) //Requestライブラリを使う宣言
    {
        //フォームデータから送信されるものをバリデート検証する
        $this->validate($request, [
            'content' => 'required|max:191', //required＝空っぽでない、かつ、191文字を超えない
        ]);
        
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        return redirect()->back();  
    }
    public function destroy($id) 
    {
        $micropost = \App\Micropost::find($id); //Micropostモデル＝テーブルにルーティングからきたidを入れて 
        
        if (\Auth::id() === $micropost->user_id){ //ログインしている人のIdとそのマイクロポストのユーザーidを比べる
            $micropost->delete();
        }
        
        return redirect()->back();
    }
}
