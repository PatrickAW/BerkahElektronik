<?php

namespace App\Http\Controllers;

use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya admin yang bisa lihat semua transaction items
        $this->authorize('viewAny', TransactionItem::class);
        
        $transactionItems = TransactionItem::with(['transaction.user', 'product'])
            ->latest()
            ->paginate(20);
            
        return view('transaction-items.index', compact('transactionItems'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionItem $transactionItem)
    {
        // Authorization check
        $this->authorize('view', $transactionItem);
        
        $transactionItem->load(['transaction.user', 'product.category']);
        
        return view('transaction-items.show', compact('transactionItem'));
    }
}