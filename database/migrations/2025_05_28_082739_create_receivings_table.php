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
        Schema::create('receivings', function (Blueprint $table) {
            $table->id();
            $table->string('specimen_id');
            $table->timestamp('received_at')->useCurrent();
            $table->integer('received_by_user_id');
            $table->string('submitted_by')->nullable();
            $table->integer('source_location_id')->nullable();
            $table->string('condition')->default('intact');
            $table->text('remarks')->nullable();
            $table->string('status')->default('received')->comment('received, rejected, pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivings');
    }
};
