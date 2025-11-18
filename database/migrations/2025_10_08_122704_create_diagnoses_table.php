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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->references('id')
                ->on('customers')
                ->cascadeOnDelete()
                ->nullable();
            $table->unsignedBigInteger('company_id')->references('id')
                ->on('companies')
                ->cascadeOnDelete()
                ->nullable();
            $table->string('vehicle_number');
            $table->text('diagnosis');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
