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
        Schema::create('received_specimens', function (Blueprint $table) {
            $table->id();
            // Use unsignedBigInteger for foreign keys referencing auto-incrementing IDs
            $table->string('receiving_id');
            $table->string('patient_order_id'); // Assuming specimen_id in patient_orders is a string

            $table->string('specimen_code'); 
            $table->string('specimen_type')->nullable();
            $table->string('anatomical_site')->nullable();
            $table->integer('container_count')->default(1);
            $table->string('test_requested')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign key constraints
            // $table->foreign('receiving_id')->references('id')->on('receivings')->onDelete('cascade');
            $table->foreign('patient_order_id')->references('specimen_id')->on('patient_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_specimens');
    }
};
