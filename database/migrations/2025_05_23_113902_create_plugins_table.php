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
        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('plguin')->nullable();
            $table->string('class')->nullable();
            $table->string('method')->nullable();
            $table->tinyInteger('construct_classes')->nullable();
            $table->tinyInteger('enabled')->nullable();
            $table->integer('user_id')->nullable();
            $table->tinyInteger('is_phase')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugins');
    }
};
