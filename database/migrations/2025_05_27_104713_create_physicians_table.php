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
        Schema::create('physicians', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('diplomat')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('license_no')->nullable();
            $table->string('ptr_no')->nullable();
            $table->string('clinic_name')->nullable();
            $table->string('clinic_address')->nullable();
            $table->string('clinic_contact_no')->nullable();
            $table->string('clinic_contact_person')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physicians');
    }
};
