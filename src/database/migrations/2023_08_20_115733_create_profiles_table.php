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
        Schema::create('profiles', function (Blueprint $table) {
            // Primary Key
            $table->bigIncrements('id')->autoIncrement();
            // usersテーブルのid
            $table->unsignedBigInteger('user_id');
            // 後でマイページから編集できるようにnullable()でnullを許容
            // user(1P)
            // -------------------------------------
            // 本名: 同姓同名のケースを考慮してunique()はなし
            $table->string('name')->nullable();
            // 生年月日
            $table->datetime('birth')->nullable();
            // -------------------------------------￥
            // -------------------------------------
            // アカウント登録日時: timestampは2038年問題を回避できないのでdatetime
            $table->datetime('created_at')->useCurrent();
            // アカウント更新日時: timestampは2038年問題を回避できないのでdatetime
            $table->datetime('updated_at')->useCurrent();
            // -------------------------------------
            // 外部キー制約
            // onDelete('cascade'): usersのレコードが削除されるとこのテーブルの当該users_idレコードも削除される
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};