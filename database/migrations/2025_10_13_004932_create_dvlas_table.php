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
        Schema::create('dvlas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('vehicle_number');
            $table->string('vehicle_make')->nullable();
            $table->string('colour')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('origin_country')->nullable();
            $table->year('manufacture_year')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('axles_number')->nullable();
            $table->integer('wheels_number')->nullable();
            $table->string('front_tyres')->nullable();
            $table->string('middle_tyres')->nullable();
            $table->string('rear_tyres')->nullable();
            $table->string('front_axle_load')->nullable();
            $table->string('middle_axle_load')->nullable();
            $table->string('rear_axle_load')->nullable();
            $table->integer('nvw')->nullable();
            $table->integer('gvw')->nullable();
            $table->integer('load')->nullable();
            $table->integer('persons_number')->nullable();
            $table->string('engine_make')->nullable();
            $table->string('engine_number')->nullable();
            $table->integer('cylinders_number')->nullable();
            $table->string('cc')->nullable();
            $table->string('hp')->nullable();
            $table->string('fuel')->nullable();
            $table->string('use')->nullable();
            $table->date('entry_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dvlas');
    }
};
