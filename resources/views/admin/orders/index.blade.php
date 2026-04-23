@extends('admin.layout')

@section('content')
@php
    $currency = auth()->user()?->currency ?? session('currency', 'HUF');

    $formatMoney = function ($amountHuf) use ($currency) {
        if ($currency === 'EUR') {
            $eur = round($amountHuf / 381, 2);
            return '€' . number_format($eur, 2, '.', ' ');
        }

        return number_format($amountHuf, 0, ',', ' ') . ' Ft';
    };
@endphp

<div class="p-8 orders-page">

    <h1 class="text-3xl font-bold mb-6 orders-title">{{ __('admin.orders.title') }}</h1>

    <form method="GET" class="mb-6 flex flex-wrap gap-3 items-end orders-filters">
        <div class="flex flex-col orders-filter-item">
            <label class="text-xs text-gray-600 mb-1">{{ __('admin.orders.filters.payment') }}</label>
            <select name="payment_status" class="px-4 py-2 border rounded-lg bg-white orders-select">
                @php $ps = request('payment_status', 'all'); @endphp

                <option value="all" {{ $ps === 'all' ? 'selected' : '' }}>{{ __('admin.orders.filters.all') }}</option>
                <option value="unpaid" {{ $ps === 'unpaid' ? 'selected' : '' }}>{{ __('admin.orders.payment_status.unpaid') }}</option>
                <option value="pending" {{ $ps === 'pending' ? 'selected' : '' }}>{{ __('admin.orders.payment_status.pending') }}</option>
                <option value="paid" {{ $ps === 'paid' ? 'selected' : '' }}>{{ __('admin.orders.payment_status.paid') }}</option>
                <option value="failed" {{ $ps === 'failed' ? 'selected' : '' }}>{{ __('admin.orders.payment_status.failed') }}</option>
                <option value="refunded" {{ $ps === 'refunded' ? 'selected' : '' }}>{{ __('admin.orders.payment_status.refunded') }}</option>
            </select>
        </div>

        <div class="flex flex-col orders-filter-item">
            <label class="text-xs text-gray-600 mb-1">{{ __('admin.orders.filters.fulfillment') }}</label>
            <select name="fulfillment_status" class="px-4 py-2 border rounded-lg bg-white orders-select">
                @php $fs = request('fulfillment_status', 'all'); @endphp

                <option value="all" {{ $fs === 'all' ? 'selected' : '' }}>{{ __('admin.orders.filters.all') }}</option>
                <option value="new" {{ $fs === 'new' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.new') }}</option>
                <option value="processing" {{ $fs === 'processing' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.processing') }}</option>
                <option value="ready_for_pickup" {{ $fs === 'ready_for_pickup' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.ready_for_pickup') }}</option>
                <option value="shipped" {{ $fs === 'shipped' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.shipped') }}</option>
                <option value="delivered" {{ $fs === 'delivered' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.delivered') }}</option>
                <option value="completed" {{ $fs === 'completed' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.completed') }}</option>
                <option value="cancelled" {{ $fs === 'cancelled' ? 'selected' : '' }}>{{ __('admin.orders.fulfillment_status.cancelled') }}</option>
            </select>
        </div>

        <div class="flex flex-col orders-filter-item">
            <label class="text-xs text-gray-600 mb-1">{{ __('admin.orders.filters.method') }}</label>
            <select name="payment_method" class="px-4 py-2 border rounded-lg bg-white orders-select">
                @php $pm = request('payment_method', 'all'); @endphp

                <option value="all" {{ $pm === 'all' ? 'selected' : '' }}>{{ __('admin.orders.filters.all') }}</option>
                <option value="card" {{ $pm === 'card' ? 'selected' : '' }}>{{ __('admin.orders.payment_method.card') }}</option>
                <option value="cod" {{ $pm === 'cod' ? 'selected' : '' }}>{{ __('admin.orders.payment_method.cod') }}</option>
                <option value="pickup" {{ $pm === 'pickup' ? 'selected' : '' }}>{{ __('admin.orders.payment_method.pickup') }}</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg orders-filter-btn">
            {{ __('admin.orders.filters.filter_button') }}
        </button>

        <a href="{{ route('admin.orders.index') }}"
           class="px-4 py-2 rounded-lg border bg-white text-gray-700 orders-reset-btn">
            {{ __('admin.orders.filters.reset_button') }}
        </a>
    </form>

        {{-- DESKTOP TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-hidden orders-table-desktop">
        <table class="w-full text-left text-sm orders-table">
            <thead class="bg-gray-50 border-b text-gray-600">
                <tr>
                    <th class="py-3 px-4">{{ __('admin.orders.table.order') }}</th>
                    <th class="py-3 px-4">{{ __('admin.orders.table.user') }}</th>
                    <th class="py-3 px-4">{{ __('admin.orders.table.total') }}</th>
                    <th class="py-3 px-4">{{ __('admin.orders.table.date') }}</th>
                    <th class="py-3 px-4">{{ __('admin.orders.table.status') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">#{{ $order->id }}</td>
                        <td class="px-4">{{ $order->user->name }}</td>
                        <td class="px-4">{{ $formatMoney($order->total) }}</td>
                        <td class="px-4">{{ $order->created_at->format('Y.m.d.') }}</td>
                        <td class="px-4">
                            @include('admin.orders.status-badge', [
                                'payment_status' => $order->payment_status,
                                'fulfillment_status' => $order->fulfillment_status,
                                'payment_method' => $order->payment_method,
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-4 text-center text-gray-500">
                            {{ __('admin.orders.empty') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARDS --}}
    <div class="orders-mobile-list">
        @forelse ($orders as $order)
            <article class="order-mobile-card">
                <div class="order-mobile-top">
                    <div>
                        <div class="order-mobile-id">#{{ $order->id }}</div>
                        <div class="order-mobile-user">{{ $order->user->name }}</div>
                    </div>

                    <div class="order-mobile-price">
                        {{ $formatMoney($order->total) }}
                    </div>
                </div>

                <div class="order-mobile-meta">
                    <div class="order-mobile-row">
                        <span class="label">{{ __('admin.orders.table.date') }}</span>
                        <span class="value">{{ $order->created_at->format('Y.m.d.') }}</span>
                    </div>

                    <div class="order-mobile-row order-mobile-status-row">
                        <span class="label">{{ __('admin.orders.table.status') }}</span>
                        <span class="value">
                            @include('admin.orders.status-badge', [
                                'payment_status' => $order->payment_status,
                                'fulfillment_status' => $order->fulfillment_status,
                                'payment_method' => $order->payment_method,
                            ])
                        </span>
                    </div>
                </div>
            </article>
        @empty
            <div class="order-mobile-card text-center text-gray-500">
                {{ __('admin.orders.empty') }}
            </div>
        @endforelse
    </div>

</div>
@endsection