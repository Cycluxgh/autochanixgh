<?php

use App\CustomerStatusEnum;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone');
            $table->enum('gender', [array_column(\App\GenderEnum::cases(), 'value')])->nullable();
            $table->enum('marital_status', [array_column(\App\MaritalStatusEnum::cases(), 'value')])
                ->nullable();
            $table->string('work_place')->nullable();
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', [array_column(CustomerStatusEnum::cases(), 'value')])
                ->default(CustomerStatusEnum::ACTIVE->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
