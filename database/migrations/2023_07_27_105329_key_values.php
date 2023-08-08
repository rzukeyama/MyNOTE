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
        /**
         * users
         * 利用者管理
         */
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')
                ->comment('個人識別番号')
                ->primary();
            $table->string('email', 512)
                ->comment('認証用Eメールアドレス');
            $table->string('password', 512)
                ->comment('認証用パスワード');
            $table->string('display_name', 50)
                ->comment('表示名')
                ->nullable();
            $table->timestamps();
        });

        /**
         * functions
         * 機能マスタ
         */
        Schema::create('functions', function (Blueprint $table) {
            $table->tinyInteger('id')
                ->comment('識別番号')
                ->unsigned()
                ->autoIncrement();
            $table->string('name')
                ->comment('機能名称');
            $table->string('route')
                ->comment('ルート名');
            $table->timestamps();
        });

        /**
         * user_functions
         * 利用者が使用できる機能
         */
        Schema::create('user_functions', function (Blueprint $table) {
            $table->uuid('id')
                ->comment('識別番号')
                ->primary();
            $table->uuid('user_id')
                ->comment('users.id');
            $table->tinyInteger('function_id')
                ->comment('functions.id')
                ->unsigned();
            $table->timestamps();
        });

        /**
         * memo_lines
         * 一行メモ
         */
        Schema::create('memo_lines', function (Blueprint $table) {
            $table->uuid('id')
                ->comment('識別番号')
                ->primary();
            $table->uuid('user_id')
                ->comment('users.id');
            $table->string('memo', 100)
                ->comment('メモの内容')
                ->nullable();
            $table->timestamps();
        });

        /**
         * key_values
         * パスワード管理
         */
        Schema::create('key_values', function (Blueprint $table) {
            $table->uuid('id')
                ->comment('識別番号')
                ->primary();
            $table->uuid('user_id')
                ->comment('users.id');
            $table->string('name', 50)
                ->comment('識別名');
            $table->string('key', 50)
                ->comment('キー');
            $table->string('value', 500)
                ->comment('値（暗号化後）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('users');
        //Schema::dropIfExists('functions');
        //Schema::dropIfExists('user_functions');
        //Schema::dropIfExists('memo_lines');
        //Schema::dropIfExists('key_values');
    }
};
