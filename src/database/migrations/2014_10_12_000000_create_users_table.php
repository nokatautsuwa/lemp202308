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
        Schema::create('users', function (Blueprint $table) {
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // アカウント情報登録(1P)
            // -------------------------------------
            // アカウント名: マイページに表示される名前
            $table->string('name');
            // [必須]アカウントID: 半角英数字のみ/同じ文字列は登録できないようにする
            $table->string('account_id');
            // 登録メールアドレス: 同じメールアドレスは登録できないようにする
            $table->string('email');
            // [必須]パスワード: 英数字8文字以上
            $table->string('password');
            // -------------------------------------
            // その他: フォームには入れず登録時に自動で反映される(後でマイページで編集できるようにする)
            // -------------------------------------
            // 自己紹介文
            $table->string('bio')->default('よろしくお願いいたします。');
            // プロフィールアイコン: 画像のファイルパスのみ
            $table->string('image')->default('icon_default.svg');
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
        Schema::dropIfExists('users');
    }
};
