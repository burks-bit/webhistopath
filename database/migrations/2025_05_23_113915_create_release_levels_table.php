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
        Schema::create('release_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('sequence');
            $table->integer('release_status');
            $table->integer('order_status');
            $table->integer('result_status');
            $table->tinyInteger('dashboard_view');
            $table->tinyInteger('for_release');
            $table->tinyInteger('enabled');
            $table->integer('user_id');
            $table->string('parent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_levels');
    }
};
