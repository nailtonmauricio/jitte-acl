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
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('workload_id')->constrained();
            $table->foreignId('work_schedule_id')->constrained();
            $table->time('record_a')->nullable(true);
            $table->time('record_b')->nullable(true);
            $table->time('record_c')->nullable(true);
            $table->time('record_d')->nullable(true);
            $table->time('record_e')->nullable(true);
            $table->time('record_f')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
