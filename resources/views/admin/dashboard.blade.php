@extends('admin.layout')

@section('content')
<div class="p-6">

<<<<<<< HEAD
<<<<<<< HEAD
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
=======
    <h1 class="text-3xl font-bold mb-6">{{ __('admin.dashboard.title') }}</h1>
>>>>>>> fc7673c (frontend update and some new feature)
=======
    <h1 class="text-3xl font-bold mb-6">{{ __('admin.dashboard.title') }}</h1>
>>>>>>> 5c55d34 (new features)

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-blue-500 text-white rounded-xl p-6 shadow-md">
            <div class="text-4xl font-bold">{{ $salesToday }}</div>
<<<<<<< HEAD
<<<<<<< HEAD
            <div class="opacity-90">Sales Today</div>
=======
            <div class="opacity-90">{{ __('admin.dashboard.sales_today') }}</div>
>>>>>>> fc7673c (frontend update and some new feature)
=======
            <div class="opacity-90">{{ __('admin.dashboard.sales_today') }}</div>
>>>>>>> 5c55d34 (new features)
        </div>

        <div class="bg-green-500 text-white rounded-xl p-6 shadow-md">
            <div class="text-4xl font-bold">{{ $activeProducts }}</div>
<<<<<<< HEAD
<<<<<<< HEAD
            <div class="opacity-90">Active Products</div>
=======
            <div class="opacity-90">{{ __('admin.dashboard.active_products') }}</div>
>>>>>>> fc7673c (frontend update and some new feature)
=======
            <div class="opacity-90">{{ __('admin.dashboard.active_products') }}</div>
>>>>>>> 5c55d34 (new features)
        </div>

        <div class="bg-red-500 text-white rounded-xl p-6 shadow-md">
            <div class="text-4xl font-bold">{{ $outOfStock }}</div>
<<<<<<< HEAD
<<<<<<< HEAD
            <div class="opacity-90">Out of Stock</div>
=======
            <div class="opacity-90">{{ __('admin.dashboard.out_of_stock') }}</div>
>>>>>>> fc7673c (frontend update and some new feature)
=======
            <div class="opacity-90">{{ __('admin.dashboard.out_of_stock') }}</div>
>>>>>>> 5c55d34 (new features)
        </div>

        <div class="bg-yellow-500 text-white rounded-xl p-6 shadow-md">
            <div class="text-4xl font-bold">{{ $activeUsers }}</div>
<<<<<<< HEAD
<<<<<<< HEAD
            <div class="opacity-90">Active Users</div>
        </div>
    </div>


=======
=======
>>>>>>> 5c55d34 (new features)
            <div class="opacity-90">{{ __('admin.dashboard.active_users') }}</div>
        </div>
    </div>

<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    {{-- CHART + RECENT ORDERS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- SALES CHART --}}
        <div class="bg-white rounded-xl shadow p-6">
<<<<<<< HEAD
<<<<<<< HEAD
            <h2 class="text-lg font-semibold mb-4">Sales This Week</h2>
=======
            <h2 class="text-lg font-semibold mb-4">{{ __('admin.dashboard.sales_this_week') }}</h2>
>>>>>>> fc7673c (frontend update and some new feature)
=======
            <h2 class="text-lg font-semibold mb-4">{{ __('admin.dashboard.sales_this_week') }}</h2>
>>>>>>> 5c55d34 (new features)

            {{-- Data passed to JS --}}
            <div id="chartData"
                 data-labels='@json($chartLabels)'
                 data-values='@json($chartValues)'></div>

            <canvas id="salesChart" height="140"></canvas>
        </div>

<<<<<<< HEAD
<<<<<<< HEAD

        {{-- RECENT ORDERS --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Recent Orders</h2>
=======
        {{-- RECENT ORDERS --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('admin.dashboard.recent_orders') }}</h2>
>>>>>>> fc7673c (frontend update and some new feature)
=======
        {{-- RECENT ORDERS --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('admin.dashboard.recent_orders') }}</h2>
>>>>>>> 5c55d34 (new features)

            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b">
<<<<<<< HEAD
<<<<<<< HEAD
                        <th class="py-2 font-medium">Order</th>
                        <th class="py-2 font-medium">Customer</th>
                        <th class="py-2 font-medium">Date</th>
                        <th class="py-2 font-medium">Total</th>
=======
=======
>>>>>>> 5c55d34 (new features)
                        <th class="py-2 font-medium">{{ __('admin.dashboard.table.order') }}</th>
                        <th class="py-2 font-medium">{{ __('admin.dashboard.table.customer') }}</th>
                        <th class="py-2 font-medium">{{ __('admin.dashboard.table.date') }}</th>
                        <th class="py-2 font-medium">{{ __('admin.dashboard.table.total') }}</th>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                    </tr>
                </thead>
                <tbody>
                @forelse ($recentOrders as $order)
                    <tr class="border-b">
                        <td class="py-2 font-semibold">#{{ $order->id }}</td>
<<<<<<< HEAD
<<<<<<< HEAD
                        <td>{{ $order->user->name ?? 'Unknown' }}</td>
=======
                        <td>{{ $order->user->name ?? __('admin.dashboard.unknown_customer') }}</td>
>>>>>>> fc7673c (frontend update and some new feature)
=======
                        <td>{{ $order->user->name ?? __('admin.dashboard.unknown_customer') }}</td>
>>>>>>> 5c55d34 (new features)
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>€{{ number_format($order->total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-gray-500 text-center">
<<<<<<< HEAD
<<<<<<< HEAD
                            No recent orders.
=======
                            {{ __('admin.dashboard.no_recent_orders') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
                            {{ __('admin.dashboard.no_recent_orders') }}
>>>>>>> 5c55d34 (new features)
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

<<<<<<< HEAD
<<<<<<< HEAD

@push('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Custom chart script --}}
<script src="{{ asset('js/chart.js') }}"></script>
@endpush
=======
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/chart.js') }}"></script>
@endpush
>>>>>>> fc7673c (frontend update and some new feature)
=======
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/chart.js') }}"></script>
@endpush
>>>>>>> 5c55d34 (new features)
