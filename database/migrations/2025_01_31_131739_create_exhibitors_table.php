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
        Schema::create('exhibitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('status')->default('pending'); //'pending', 'confirmed', 'canceled'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibitors');
    }
};
