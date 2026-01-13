<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('popup_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('image_url');
            $table->string('image_alt')->nullable();
            $table->string('link_url')->nullable();
            $table->boolean('open_in_new_tab')->default(false);
            $table->boolean('show_on_first_visit_only')->default(false);
            $table->integer('delay_before_show')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popup_settings');
    }
};
