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
        Schema::create('info_p_p_d_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('color_scheme')->default('green');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('features')->nullable();
            $table->json('requirements')->nullable();
            $table->integer('capacity')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('duration')->nullable();
            $table->enum('program_type', ['fullday', 'fullday-olahraga', 'fullday-it', 'boarding'])->default('fullday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_p_p_d_b_s');
    }
}; 