@extends('admin.layout')

@section('content')
<div class="p-8">

    <h1 class="text-3xl font-bold mb-6">Orders</h1>

    {{-- Filters --}}
    <form method="GET" class="mb-6 flex flex-wrap gap-3 items-end">

        {{-- Payment status filter --}}
        <div class="flex flex-col">
            <label class="text-xs text-gray-600 mb-1">Payment</label>
            <select name="payment_status" class="px-4 py-2 border rounded-lg bg-white">
                @php
                    $ps = request('payment_status', 'all');
                @endphp
                <option value="all" {{ $ps === 'all' ? 'selected' : '' }}>All</option>
                <option value="unpaid" {{ $ps === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="pending" {{ $ps === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $ps === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="failed" {{ $ps === 'failed' ? 'selected' : '' }}>Failed</option>
                <option value="refunded" {{ $ps === 'refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
        </div>

        {{-- Fulfillment status filter --}}
        <div class="flex flex-col">
            <label class="text-xs text-gray-600 mb-1">Fulfillment</label>
            <select name="fulfillment_status" class="px-4 py-2 border rounded-lg bg-white">
                @php
                    $fs = request('fulfillment_status', 'all');
                @endphp
                <option value="all" {{ $fs === 'all' ? 'selected' : '' }}>All</option>
                <option value="new" {{ $fs === 'new' ? 'selected' : '' }}>New</option>
                <option value="processing" {{ $fs === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="ready_for_pickup" {{ $fs === 'ready_for_pickup' ? 'selected' : '' }}>Ready for pickup</option>
                <option value="shipped" {{ $fs === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ $fs === 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="completed" {{ $fs === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $fs === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        {{-- Payment method filter --}}
        <div class="flex flex-col">
            <label class="text-xs text-gray-600 mb-1">Method</label>
            <select name="payment_method" class="px-4 py-2 border rounded-lg bg-white">
                @php
                    $pm = request('payment_method', 'all');
                @endphp
                <option value="all" {{ $pm === 'all' ? 'selected' : '' }}>All</option>
                <option value="card" {{ $pm === 'card' ? 'selected' : '' }}>Card</option>
                <option value="cod" {{ $pm === 'cod' ? 'selected' : '' }}>COD</option>
                <option value="pickup" {{ $pm === 'pickup' ? 'selected' : '' }}>Pickup</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Filter</button>

        <a href="{{ route('admin.orders.index') }}"
           class="px-4 py-2 rounded-lg border bg-white text-gray-700">
            Reset
        </a>
    </form>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b text-gray-600">
                <tr>
                    <th class="py-3 px-4">Order</th>
                    <th class="py-3 px-4">User</th>
                    <th class="py-3 px-7">Total</th>
                    <th class="py-3 px-8">Date</th>
                    <th class="py-3 px-6">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-semibold">#{{ $order->id }}</td>
                    <td class="px-4">{{ $order->user->name }}</td>
                    <td class="px-4">€{{ number_format($order->total, 2) }}</td>
                    <td class="px-4">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-4">
                        @include('admin.orders.status-badge', [
                            'payment_status' => $order->payment_status,
                            'fulfillment_status' => $order->fulfillment_status,
                            'payment_method' => $order->payment_method,
                        ])
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection
