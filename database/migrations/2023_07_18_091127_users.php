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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
