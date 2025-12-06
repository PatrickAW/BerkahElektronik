<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');
        
        $products = Product::when($keyword, function ($query, $keyword) {
            return $query->where('judul', 'like', '%' . $keyword . '%');
        })
        ->latest()
        ->paginate(20);
        
        return view('products.index', compact('products', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function search(Request $request): View
    {
        $keyword = $request->input('keyword', '');
        
        $products = Product::where('judul', 'like', '%' . $keyword . '%')
            ->orWhere('brand', 'like', '%' . $keyword . '%')
            ->orWhere('model', 'like', '%' . $keyword . '%')
            ->latest()
            ->paginate(20);
        
        return view('products.index', compact('products', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|exists:categories,id',
            'brand' => 'required',
            'judul' => 'required',
            'model' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|integer',
            'garansi' => 'nullable',
            'detail' => 'required',
            'image' => 'nullable|url',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|exists:categories,id',
            'brand' => 'required',
            'judul' => 'required',
            'model' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|integer',
            'garansi' => 'nullable',
            'detail' => 'required',
            'image' => 'nullable|url',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}