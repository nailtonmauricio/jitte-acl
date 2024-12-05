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
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->time('first_weekly_shift_entry');
            $table->time('first_weekly_shift_exit');
            $table->time('second_weekly_shift_entry');
            $table->time('second_weekly_shift_exit');
            $table->time('weekend_shift_entry')->nullable(true);
            $table->time('weekend_shift_exit')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_schedules');
    }
};
