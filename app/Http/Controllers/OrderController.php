<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        $order->load('items.product');

        return view('orders.show', [
            'order' => $order,
        ]);
    }
}