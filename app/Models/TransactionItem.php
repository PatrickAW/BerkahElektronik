<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the transaction that owns the item.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the product associated with the item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate subtotal for this item.
     */
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    /**
     * Format price with currency.
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Format subtotal with currency.
     */
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Get product name with fallback.
     */
    public function getProductNameAttribute()
    {
        return $this->product ? $this->product->judul : 'Produk Tidak Ditemukan';
    }

    /**
     * Get product image URL.
     */
    public function getProductImageAttribute()
    {
        return $this->product ? $this->product->image_url : null;
    }

    /**
     * Get formatted quantity x price.
     */
    public function getDisplayAttribute()
    {
        return $this->quantity . ' x ' . $this->formatted_price;
    }
}