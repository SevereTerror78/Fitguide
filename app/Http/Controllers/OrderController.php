<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a single order.
     */

     public function index()
     {
         $orders = Auth::user()
             ->orders()
             ->with('items.product')
             ->where(function ($q) {
                 // ne mutassa a régi pending_payment státuszt sem
                 $q->where('payment_method', '!=', 'card')
                   ->orWhere('status', '!=', Order::STATUS_PENDING_PAYMENT);
             })
             ->latest()
             ->get();
     
         return view('orders.index', compact('orders'));
     }
     
    
    public function show(Order $order)
    {
        // biztosítjuk, hogy csak a saját rendelését lássa
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        // betöltjük a rendelés tételeit és termékeket
        $order->load('items.product');

        return view('orders.show', [
            'order' => $order
        ]);
    }
}
