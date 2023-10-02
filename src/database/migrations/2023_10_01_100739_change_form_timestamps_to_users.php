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
        Schema::table('users', function (Blueprint $table) {
            // created_at と updated_at をtimestamp型に置き換える
            // 2038年問題は32ビット符号付き整数の場合に懸念される
            // 現在は64bitのデータ型(例: BIGINT、DOUBLE、TIMESTAMP)を扱うことができるのでわざわざdatetimeに変える必要はないと考えられる
            $table->timestamp('created_at')->useCurrent()->change();
            $table->timestamp('updated_at')->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
