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
        Schema::create('follows', function (Blueprint $table) {
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // フォローした/されたuserのaccount_id
            $table->unsignedBigInteger('follow_id');
            $table->unsignedBigInteger('follower_id');
            // 登録/更新日時
            $table->timestamps();
            // 外部キー制約
            // onDelete('cascade'): usersのレコードが削除されるとこのテーブルの当該user_idレコードも削除される
            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');
            // onDelete('cascade'): usersのレコードが削除されるとこのテーブルの当該follow_idレコードも削除される
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};