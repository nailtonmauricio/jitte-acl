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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('individual_taxpayer_registry')->comment('CPF');
            $table->string('registration_of_individual')->comment('CNH');
            $table->string('social_integration_program')->comment('PIS');
            $table->string('id_card')->comment('RG');
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->foreignId('workload_id')->constrained();
            $table->foreignId('work_schedule_id')->constrained();
            $table->date('admission_date');
            $table->string('password')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
