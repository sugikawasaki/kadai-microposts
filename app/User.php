<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     // あとでcreate()を使って一気にデータを代入するために、代入可能なパラメータを配列として代入
    protected $fillable = [ 
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     // 見られないように隠してくれる
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts() //Userからマイクロポストをみると複数のため複数系で
    {
        return $this->hasMany(Micropost::class);  //ユーザーからみるとマイクロポストは複数→hadmany　マイクロポストモデルからUser自信のマイクロポストを取得できる　$user->microposts()->all()、$user->microposts
    }
    
    public function followings() //これで$user->followingsで$userがフォローしているUser達を取得できる
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();//引数　モデルクラス、中間テーブル、中間テーブル左＝自分のid、中間テーブル右＝関係先のid
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
            //既にフォローしているかの確認
            $exist = $this->is_following($userId);
            //自分自信ではないかの確認
            $its_me = $this->id ==$userId;  //idは？Userモデルだからusersテーブルのidを指している？
            
            if ($exist || $its_me) {
                //既にフォロー、または自分自身であれば何もしない
                return false;
            } else {
                //未フォローであればフォローする=中間テーブルに保存するということ
                $this->followings()->attach($userId); //ログインしている自信のidはわかっているから、フォロー先のidのみを指定している？？
                return true;
            }
    }
    
    public function unfollow($userId)
    {
        //既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            // 既にフォロー、かつ自分自身でない(!)?場合、フォローを外す=中間テーブルから削除するということ
                $this->followings()->detach($userId);
                return true;
        } else {
            //未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists(); //where(フィールド名、価)指定したフィールドの値が第二引数と同じレコードを検索する
    }
    
    public function feed_microposts()
    {
        $follow_user_ids = $this->followings()-> pluck('users.id')->toArray(); //pluck与えられた引数のテーブルのカラム名だけを抜き出す、toArrayただの配列に変換
        $follow_user_ids[] =$this->id; //自分のidも追加
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
    public function favoritings()
    {
        return $this->belongsToMany(Micropost::class,'micropost_favorite','user_id','micropost_id')->withTimestamps();//引数モデルクラス、中間テーブル、中間テーブル左＝自分のid、中間テーブル右＝MPSのid
    }

    public function favorite($micropostId)
    {
        //既にお気に入り登録しているか確認
        $exist = $this->is_favorite($micropostId);
        
        if ($exist) {
            //既にお気に入りに登録していれば何もしない
            return false;
        }   else {
            //お気に入り登録してなければ登録する
            $this->favoritings()->attach($micropostId);
            return true;
        }

    }
    
    public function unfavorite($micropostId)
    {
        //既にお気に入り登録しているか確認
        $exist =$this->is_favorite($micropostId);
        
        if($exist) {
            //既にお気に入り登録していれば外す
            $this->favoritings()->detach($micropostId);
            return true;
        } else {
            //お気に入り登録していなければ何もしない
            return false;
        }
    }
    
    public function is_favorite($micropostId)
    {
        //いまからお気に入りしようとしているmicropostをすでにお気に入りしていないかを調べる
        //user_favoriteのテーブルのなかに、 user_id と micropost_id の同じ組み合わせがないか調べたい
        return $this->favoritings()->where('micropost_id',$micropostId)->exists(); //favoritingsに、来たmicropostのidを代入して。where第一引数：カラムを指定、第二引数：その中の内容を引き出す??
        
    }
}
