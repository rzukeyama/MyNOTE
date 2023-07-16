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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('functions');
    }
};
