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
        Schema::create('storyboard_details', function (Blueprint $table) {
            $table->id();
            $table->string('story_board_id')->nullable();
            $table->string('stage_id')->nullable();
            $table->string('phase_id')->nullable();
            $table->integer('sequence')->nullable();
            $table->integer('status')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storyboard_details');
    }
};
