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
        Schema::create('admins', function (Blueprint $table) {
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // アカウント情報登録
            // -------------------------------------
            // アカウント名: マイページに表示される名前
            $table->string('name');
            // 登録メールアドレス: 同じメールアドレスは登録できないようにする
            $table->string('email');
            // [必須]パスワード: 英数字8文字以上
            $table->string('password');
            // -------------------------------------
            // プロフィールアイコン: 画像のファイルパスのみ
            $table->string('image')->default('icon_default.svg');
            // Userの管理権限の付与(0: 権限無し / 1: 権限あり)
            $table->integer('user_authority')->default(0);
            // 編集権限フラグ(0: 権限無し / 1: 権限あり)
            // 0: 自分のプロフィールの編集/削除
            // 1: 他adminユーザーの編集/削除
            $table->integer('admin_authority')->default(0);
            // -------------------------------------
            // アカウント登録日時: timestampは2038年問題を回避できないのでdatetime
            $table->datetime('created_at')->useCurrent();
            // アカウント更新日時: timestampは2038年問題を回避できないのでdatetime
            $table->datetime('updated_at')->useCurrent();
            // -------------------------------------
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};