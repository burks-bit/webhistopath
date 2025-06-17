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
            $table->string('external_specimen_id')->nullable();
            $table->tinyInteger('branch_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('patient_type')->nullable();
            $table->string('location_id')->nullable();
            $table->date('date_requested')->nullable();
            $table->time('time_requested')->nullable();
            $table->string('user_id')->nullable();
            $table->tinyInteger('status')->nullable();
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
