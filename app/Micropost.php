<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id']; // 他の関数でを使うときに想定していないパラメータへのデータ代入を防ぎ、なおかつ、一気にデータを代入するために利用されます
    
    public function user()
    {
        return $this->belongsTo(User::class); //マイクロポストが所属している（唯一の）Userを取得できる。$micropost->user()->first(),$midropost->userで取得。
    }
}
