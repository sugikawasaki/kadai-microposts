<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
     // handle()は全てのミドルウェアが持っているもので、設定されたルーティングにアクセスされたときに呼び出される
    public function handle($request, Closure $next, $guard = null) 
    //$requestはリクエストの情報を管理するRequestインスタンスが渡される、$nextはクロージャクラス（無名クラスを表す）これを呼び出して実行することで
    //ミドルウェアからアプリケーションへと送られるリクエスト（Requestインスタンス）を作成することができる
    {
        if (Auth::guard($guard)->check()) {   // ログインしているかチェックしている。ログインしているのにログインページにアクセスしようとすると/にリダイレクトする
            return redirect('/');
        }

        return $next($request);
    }
}
