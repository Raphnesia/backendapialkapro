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
        Schema::create('sub_facility_photos', function (Blueprint $table) {
            $table->id();
            $table->string('parent_slug'); // Link ke facility_boxes.link_slug
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('parent_slug');
            $table->index('is_active');
            $table->index('order_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_facility_photos');
    }
}; 