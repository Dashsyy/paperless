<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_histories', function (Blueprint $table) {
            $table->id();
            $table->string('seeker_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('company_name');
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_histories');
    }
};
