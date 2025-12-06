<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_no',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'payment_reference',
        'shipping_address',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the transaction.
     */
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    /**
     * Format total amount with currency.
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Get status badge color.
     */
    public function getStatusColorAttribute()
    {
        switch ($this->payment_status) {
            case 'paid':
                return 'success';
            case 'pending':
                return 'warning';
            case 'failed':
                return 'danger';
            case 'cancelled':
                return 'secondary';
            default:
                return 'info';
        }
    }

    /**
     * Get order status badge color.
     */
    public function getOrderStatusColorAttribute()
    {
        switch ($this->order_status) {
            case 'processing':
                return 'info';
            case 'shipped':
                return 'primary';
            case 'delivered':
                return 'success';
            case 'cancelled':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    /**
     * Scope for pending transactions.
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    /**
     * Scope for paid transactions.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope for failed transactions.
     */
    public function scopeFailed($query)
    {
        return $query->where('payment_status', 'failed');
    }

    /**
     * Check if transaction can be cancelled.
     */
    public function getCanCancelAttribute()
    {
        return $this->payment_status === 'pending' && $this->order_status === 'processing';
    }

    /**
     * Check if transaction is completed.
     */
    public function getIsCompletedAttribute()
    {
        return $this->payment_status === 'paid' && $this->order_status === 'delivered';
    }
}