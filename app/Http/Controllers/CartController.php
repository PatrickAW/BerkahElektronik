<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->get();
        $total = 0;
        foreach ($carts as $cart) {
            if ($cart->product) {
                $total += $cart->product->harga_akhir * $cart->quantity;
            }
        }
        return view('cart.index', compact('carts', 'total'));
    }

    public function store($productId)
    {
        $product = Product::find($productId);
        if (!$product) return back()->with('error', 'Produk tidak ditemukan');
        
        $cartItem = Cart::where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->harga_akhir
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart) $cart->delete();
        return back()->with('success', 'Produk dihapus');
    }

    public function clear()
    {
        Cart::truncate();
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan');
    }
}