<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_histories', function (Blueprint $table) {
            // 各種更新情報を記録する
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // usersテーブルのid
            $table->integer('user_id');
            // usersテーブルのname
            $table->string('user_name');
            // type(文字列型にする)
            // 1: アカウント登録
            // 2: プロフィールを編集
            // 3: 管理者への問い合わせ
            // 9: アカウント削除
            $table->string('type');
            // 更新内容
            $table->string('note')->nullable();
            $table->timestamps();
            // * 履歴なので外部キー制約はしない
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_histories');
    }
};
