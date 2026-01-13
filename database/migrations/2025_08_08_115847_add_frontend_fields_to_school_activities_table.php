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
        Schema::table('school_activities', function (Blueprint $table) {
            $table->text('excerpt')->nullable()->after('description');
            $table->string('author')->default('Admin')->after('participants');
            $table->enum('type', ['prestasi', 'ekstrakurikuler', 'akademik', 'sosial'])->default('akademik')->after('author');
            $table->date('date')->nullable()->after('type'); // untuk tanggal yang ditampilkan di frontend
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_activities', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'author', 'type', 'date']);
        });
    }
};
