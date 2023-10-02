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
        Schema::create('pics', function (Blueprint $table) {
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // usersテーブルのid
            $table->unsignedBigInteger('user_id');
            // adminsテーブルのid
            $table->unsignedBigInteger('admin_id');
            // 登録日時/更新日時
            $table->timestamps();
            // 外部キー制約
            // onDelete('cascade'): users/adminのレコードが削除されるとこのテーブルの当該レコードも削除される
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pics');
    }
};
