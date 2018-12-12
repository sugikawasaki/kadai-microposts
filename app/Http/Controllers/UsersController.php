<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Micropost; //追加

class UsersController extends Controller
{
    public function index()
    {
        //Userモデル＝userテーブルのレコードをすべてとってきて、表示件数を10件とする
        $users = User::paginate(10);
        // usersフォルダindexファイルの'user'に$userを設定
        return view('users.index',[
            'users' => $users,
            ]);
    }

    public function show($id)
    {
        //Userテーブルの中から指定したidのユーザーレコードを抜き出す
        //抜き出したユーザーレコードを$userに代入
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];
        
        $data += $this->counts($user); //+-は追加する。thisは関数の外からもってくる。extendsのController
        
        return view('users.show', $data);
    }
     
    public function followings($id)
    {
        $user = User::find($id); //routeからidを得て、Userモデルからレコードを持ってくる
        $followings = $user->followings()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followings,
            ];
        
        $data += $this->counts($user);
        
        return view('users.followings', $data);
    }
    
    public function followers($id)
    {
        $user = User::find($id);  //ユーザーが一人入っている。指定されたレコードを取得name,idなど。
        $followers = $user->followers()->paginate(10);
        
        $data = [              //連想配列　値に名前をつける
            'user' => $user, // $userにuserという名前をつけている
            'users' => $followers,
        ];
        
        // $data['user']  この中には $user が入っている
        // $data['users']  この中には $followers が入っている
        
        $data += $this->counts($user);  //+=追加 $this関数の外からもってくる。counts関数ない。extendsのファイルにあるのでは？COntrollerから
        
        // $data = [              
        //     'user' => $user, 
        //     'users' => $followers,
        //     'count_microposts' => $count_microposts,
        //     'count_followings' => $count_followings,
        //     'count_followers' => $count_followers,
        //     'count_favoritings' => $count_favoritings,
        // ];
        
        return view('users.followers', $data);  // view関数のルールで、第一引数：ファイル指定、第二引数そのファイルに持っていくデータ連想配列を指定。ここで$user,$followers,とやると第二、第三引数になってダメ
    }
    
    public function favoritings($id)
    {
        $user = User::find($id);
        $microposts = $user->favoritings()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
            ];
        
        $data += $this->counts($user);
        
        return view('users.favoritings', $data);
    }
}




