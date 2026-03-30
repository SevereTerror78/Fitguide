<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * LISTA + FILTEREK
     */
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

<<<<<<< HEAD
<<<<<<< HEAD
        // 🔹 Payment status filter
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if ($request->filled('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

<<<<<<< HEAD
<<<<<<< HEAD
        // 🔹 Fulfillment status filter
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if ($request->filled('fulfillment_status') && $request->fulfillment_status !== 'all') {
            $query->where('fulfillment_status', $request->fulfillment_status);
        }

<<<<<<< HEAD
<<<<<<< HEAD
        // 🔹 Payment method filter
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if ($request->filled('payment_method') && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * ORDER RÉSZLETEI
     */
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * STATUS UPDATE (ADMIN)
     */
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status'     => 'nullable|in:unpaid,pending,paid,failed,refunded',
            'fulfillment_status' => 'nullable|in:new,processing,ready_for_pickup,shipped,delivered,completed,cancelled',
        ]);

        DB::transaction(function () use ($order, $validated) {
<<<<<<< HEAD
<<<<<<< HEAD

            /**
             * 1️⃣ FULFILLMENT STATUS
             */
            if (!empty($validated['fulfillment_status'])) {
                $order->fulfillment_status = $validated['fulfillment_status'];

                // lezárt állapot → fulfilled_at
=======
            if (!empty($validated['fulfillment_status'])) {
                $order->fulfillment_status = $validated['fulfillment_status'];

>>>>>>> fc7673c (frontend update and some new feature)
=======
            if (!empty($validated['fulfillment_status'])) {
                $order->fulfillment_status = $validated['fulfillment_status'];

>>>>>>> 5c55d34 (new features)
                if (
                    in_array($validated['fulfillment_status'], ['delivered', 'completed'], true) &&
                    is_null($order->fulfilled_at)
                ) {
                    $order->fulfilled_at = now();
                }
            }

<<<<<<< HEAD
<<<<<<< HEAD
            /**
             * 2️⃣ PAYMENT STATUS
             */
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            if (!empty($validated['payment_status'])) {
                $previous = $order->payment_status;
                $order->payment_status = $validated['payment_status'];

<<<<<<< HEAD
<<<<<<< HEAD
                // ➜ most lett paid
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                if ($validated['payment_status'] === 'paid' && $previous !== 'paid') {
                    $order->paid_at = now();
                    $order->payment_failed_at = null;
                    $order->payment_last_error = null;

<<<<<<< HEAD
<<<<<<< HEAD
                    // ✅ COD / PICKUP PONT KIOSZTÁS
                    $order->awardPointsIfEligible();
                }

                // ➜ failed
=======
                    $order->awardPointsIfEligible();
                }

>>>>>>> fc7673c (frontend update and some new feature)
=======
                    $order->awardPointsIfEligible();
                }

>>>>>>> 5c55d34 (new features)
                if ($validated['payment_status'] === 'failed') {
                    $order->payment_failed_at = now();
                }
            }

<<<<<<< HEAD
<<<<<<< HEAD
            /**
             * 3️⃣ RÉGI STATUS (legacy – opcionális)
             * Nem használjuk logikára, csak kompatibilitás
             */
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            if ($order->payment_status === 'paid') {
                $order->status = 'paid';
            } elseif ($order->payment_status === 'failed') {
                $order->status = 'failed';
            }

            $order->save();
        });

        return back()->with('success', 'Order updated successfully.');
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
}
>>>>>>> fc7673c (frontend update and some new feature)
=======
}
>>>>>>> 5c55d34 (new features)
