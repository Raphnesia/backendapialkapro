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
        Schema::table('alkapro_library_settings', function (Blueprint $table) {
            // Library Facilities Flow Section
            $table->string('facilities_flow_title')->nullable()->after('facility_features');
            $table->text('facilities_flow_description')->nullable()->after('facilities_flow_title');
            $table->json('facilities_flow_steps')->nullable()->after('facilities_flow_description');
            $table->boolean('show_facilities_flow')->default(true)->after('show_additional_services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alkapro_library_settings', function (Blueprint $table) {
            $table->dropColumn([
                'facilities_flow_title',
                'facilities_flow_description', 
                'facilities_flow_steps',
                'show_facilities_flow'
            ]);
        });
    }
};
