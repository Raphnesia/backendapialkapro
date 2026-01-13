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
        Schema::create('facility_content', function (Blueprint $table) {
            $table->id();
            $table->string('section_title');
            $table->longText('content');
            $table->string('display_type')->default('wysiwyg'); // wysiwyg, simple_text, grid
            $table->boolean('show_photo_collage')->default(true);
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('order_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_content');
    }
}; 