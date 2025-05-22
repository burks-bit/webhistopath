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
        Schema::create('test_orders', function (Blueprint $table) {
            $table->id();
            $table->string('specimen_id');
            $table->tinyInteger('order_status');
            $table->tinyInteger('branch_id');
            $table->tinyInteger('release_level_id');
            $table->date('release_date');
            $table->time('release_time');
            $table->date('cancel_date');
            $table->time('cancel_time');
            $table->string('cancelling_comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_orders');
    }
};
