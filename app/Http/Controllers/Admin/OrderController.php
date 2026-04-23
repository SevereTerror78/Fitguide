<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('fulfillment_status') && $request->fulfillment_status !== 'all') {
            $query->where('fulfillment_status', $request->fulfillment_status);
        }

        if ($request->filled('payment_method') && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
{
    $validated = $request->validate([
        'payment_status'     => 'nullable|in:unpaid,pending,paid,failed,refunded',
        'fulfillment_status' => 'nullable|in:new,processing,ready_for_pickup,shipped,delivered,completed,cancelled',
    ]);

    DB::transaction(function () use ($order, $validated) {
        if (!empty($validated['fulfillment_status'])) {
            $order->fulfillment_status = $validated['fulfillment_status'];

            if (
                in_array($validated['fulfillment_status'], ['delivered', 'completed'], true) &&
                is_null($order->fulfilled_at)
            ) {
                $order->fulfilled_at = now();
            }
        }

        if (!empty($validated['payment_status'])) {
            $previous = $order->payment_status;
            $order->payment_status = $validated['payment_status'];

            if ($validated['payment_status'] === 'paid') {
                $order->status = 'paid';
            } elseif ($validated['payment_status'] === 'failed') {
                $order->status = 'failed';
            }

            if ($validated['payment_status'] === 'paid' && $previous !== 'paid') {
                $order->paid_at = now();
                $order->payment_failed_at = null;
                $order->payment_last_error = null;

                $order->awardPointsIfEligible();
            }

            if ($validated['payment_status'] === 'failed') {
                $order->payment_failed_at = now();
            }
        }

        $order->save();
    });

    return back()->with('success', 'Order updated successfully.');
}
}