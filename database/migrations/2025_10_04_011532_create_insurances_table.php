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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->nullable();
            $table->unsignedBigInteger('company_id')->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->nullable();
            $table->string('vehicle_number')->unique();
            $table->date('inception');
            $table->date('expiration');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
