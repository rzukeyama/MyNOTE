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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_functions');
    }
};
