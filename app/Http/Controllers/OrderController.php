<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======
>>>>>>> 5c55d34 (new features)

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->where('user_id', Auth::id())
            ->whereNot(function ($q) {
                $q->where('payment_method', 'card')
                  ->where('status', Order::STATUS_PENDING_PAYMENT);
            })
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

<<<<<<< HEAD
<<<<<<< HEAD
        // betöltjük a rendelés tételeit és termékeket
        $order->load('items.product');

        return view('orders.show', [
            'order' => $order
        ]);
    }
}
=======
=======
>>>>>>> 5c55d34 (new features)
        $order->load('items.product');

        return view('orders.show', [
            'order' => $order,
        ]);
    }
<<<<<<< HEAD
}
>>>>>>> fc7673c (frontend update and some new feature)
=======
}
>>>>>>> 5c55d34 (new features)
