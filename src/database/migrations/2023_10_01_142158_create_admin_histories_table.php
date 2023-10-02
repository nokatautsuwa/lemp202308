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
        Schema::create('admin_histories', function (Blueprint $table) {
            // 各種更新情報を記録する
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // adminsテーブルのid
            $table->unsignedBigInteger('admin_id');
            // adminsテーブルのname
            $table->string('admin_name');
            // type(文字列型にする)
            // 1: アカウント登録
            // 2: プロフィールを編集
            // 3: 所属/エリアの変更
            // 4: 権限の変更
            // 5: ユーザーの担当変更
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
        Schema::dropIfExists('admin_histories');
    }
};
