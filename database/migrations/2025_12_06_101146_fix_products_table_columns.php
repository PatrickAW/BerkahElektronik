<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Cek dan tambah hanya kolom yang belum ada
            $columnsToAdd = [
                'is_active' => ['type' => 'boolean', 'default' => true, 'after' => 'image'],
                // Tambahkan kolom lain jika diperlukan
            ];
            
            foreach ($columnsToAdd as $columnName => $config) {
                if (!Schema::hasColumn('products', $columnName)) {
                    if ($config['type'] === 'boolean') {
                        $table->boolean($columnName)->default($config['default'])->after($config['after']);
                    }
                    // Tambahkan tipe data lain jika diperlukan
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hanya drop kolom yang kita tambahkan di migration ini
            $table->dropColumnIfExists('is_active');
        });
    }
};