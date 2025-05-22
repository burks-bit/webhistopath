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
        Schema::create('patient_orders', function (Blueprint $table) {
            $table->string('specimen_id')->primary();
            $table->string('external_specimen_id');
            $table->tinyInteger('branch_id');
            $table->string('patient_id');
            $table->string('patient_type');
            $table->string('location_id');
            $table->date('date_requested');
            $table->time('time_requested');
            $table->string('user_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_orders');
    }
};
