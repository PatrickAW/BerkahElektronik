<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori', 'brand', 'judul', 'model', 'stok', 
        'harga', 'diskon', 'harga_akhir', 'garansi', 'detail', 'image'
    ];

    // Relasi ke cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Attribute accessor untuk harga diskon
    public function getHargaAkhirAttribute()
    {
        if ($this->diskon > 0) {
            return $this->harga - ($this->harga * $this->diskon / 100);
        }
        return $this->harga;
    }
}