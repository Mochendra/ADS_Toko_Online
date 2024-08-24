<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_pengiriman' => 'required|string|max:255',
        ]);


        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('payment_proofs', 'public');


        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = $request->session()->get('total'); // Ambil total dari session
        $order->payment_proof_path = $buktiPembayaranPath;
        $order->shipping_address = $request->alamat_pengiriman;
        $order->status = 'pending';
        $order->save();


        foreach ($request->session()->get('cart') as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
            ]);
        }


        $request->session()->forget('cart');
        $request->session()->forget('total');

        return redirect()->route('dashboard')->with('success', 'Order berhasil dibuat!');
    }
}
