<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // ini harus ada
            $table->string('brand');
            $table->string('judul');
            $table->string('model');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 15, 2);
            $table->integer('diskon')->default(0);
            $table->decimal('harga_akhir', 15, 2);
            $table->string('garansi');
            $table->text('detail')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
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