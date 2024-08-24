<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {

        $cart = Session::get('cart', []);


        $total = 0;


        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        return view('auth.keranjang', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $product = Product::find($productId);


        $cart = Session::get('cart', []);


        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image_path' => $product->image_path,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('keranjang')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Retrieve cart from session
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
        }


        Session::put('cart', $cart);


        return redirect()->route('keranjang')->with('success', 'Cart updated!');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');


        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }


        Session::put('cart', $cart);

        return redirect()->route('keranjang')->with('success', 'Product removed from cart!');
    }
    public function checkout()
    {

        $cart = Session::get('cart', []);


        $total = 0;


        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        return view('auth.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {

        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $cart = Session::get('cart', []);


        $total = 0;


        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }


        $paymentProofPath = $request->file('payment_proof')
            ? $request->file('payment_proof')->store('uploads/payment_proofs', 'public')
            : null;


        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'shipping_address' => $request->shipping_address,
            'payment_proof_path' => $paymentProofPath,
            'status' => 'pending',
        ]);


        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
            ]);
        }


        Session::forget('cart');

        return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
    }
}
