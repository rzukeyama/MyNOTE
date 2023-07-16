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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memo_lines');
    }
};
