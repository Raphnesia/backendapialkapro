<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Cek struktur table
        $columns = DB::select('DESCRIBE info_p_p_d_b_settings');
        
        // Log hasilnya
        \Log::info('Table info_p_p_d_b_settings structure:', $columns);
        
        // Cek apakah column is_active ada
        $hasIsActive = collect($columns)->contains('Field', 'is_active');
        
        if (!$hasIsActive) {
            // Tambah column is_active jika tidak ada
            Schema::table('info_p_p_d_b_settings', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('id');
            });
        }
    }

    public function down()
    {
        // Tidak perlu down karena ini cuma cek struktur
    }
};