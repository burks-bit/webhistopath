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
        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->integer('stage_id');
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sequence')->nullable();
            $table->integer('function_id')->nullable();
            $table->integer('custom_function_id')->nullable();
            $table->tinyInteger('significance')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('sequential')->nullable();
            $table->integer('view_function_id')->nullable();
            $table->tinyInteger('transaction_type')->nullable();
            $table->tinyInteger('sub_type')->nullable();
            $table->string('quick_function_id')->nullable();
            $table->tinyInteger('password_protected')->nullable();
            $table->tinyInteger('single_user')->nullable();
            $table->datetime('performed_datetime')->nullable();
            $table->tinyInteger('locked')->nullable();
            $table->integer('performed_by')->nullable();
            $table->integer('release_heirarchy')->nullable();
            $table->tinyInteger('multilevel')->nullable();
            $table->tinyInteger('physician')->nullable();
            $table->integer('required_release_level')->nullable();
            $table->integer('auto_assign')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
    }
};
