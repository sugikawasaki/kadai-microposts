<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicroposts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microposts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index(); //integer=整数 unsigned＝負の数は許可しない、index索引みたいなものカラムの検索速度を高める
            $table->string('content');
            $table->timestamps();
            
            //外部キー制約 foreign(外部キーを設定するカラム名),referennces（制約先のID名）,on(外部キーの制約先のテーブル名)
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('microposts');
    }
}
