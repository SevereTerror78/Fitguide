@extends('admin.layout')

@section('content')
<div class="p-4 md:p-6">

    <h1 class="text-2xl md:text-3xl font-bold mb-6">{{ __('admin.dashboard.title') }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8 dashboard-cards">

        <div class="bg-blue-500 text-white rounded-xl p-4 md:p-6 shadow-md">
            <div class="text-2xl md:text-4xl font-bold">{{ $salesToday }}</div>
            <div>{{ __('admin.dashboard.sales_today') }}</div>
        </div>

        <div class="bg-green-500 text-white rounded-xl p-4 md:p-6 shadow-md">
            <div class="text-2xl md:text-4xl font-bold">{{ $activeProducts }}</div>
            <div>{{ __('admin.dashboard.active_products') }}</div>
        </div>

        <div class="bg-red-500 text-white rounded-xl p-4 md:p-6 shadow-md">
            <div class="text-2xl md:text-4xl font-bold">{{ $outOfStock }}</div>
            <div>{{ __('admin.dashboard.out_of_stock') }}</div>
        </div>

        <div class="bg-yellow-500 text-white rounded-xl p-4 md:p-6 shadow-md">
            <div class="text-2xl md:text-4xl font-bold">{{ $activeUsers }}</div>
            <div>{{ __('admin.dashboard.active_users') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl shadow p-4 md:p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('admin.dashboard.sales_this_week') }}</h2>

            <div id="chartData"
                 data-labels='@json($chartLabels)'
                 data-values='@json($chartValues)'></div>

            <canvas id="salesChart"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('admin.dashboard.recent_orders') }}</h2>

            <div class="table-wrapper">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">{{ __('admin.dashboard.table.order') }}</th>
                            <th>{{ __('admin.dashboard.table.customer') }}</th>
                            <th>{{ __('admin.dashboard.table.date') }}</th>
                            <th>{{ __('admin.dashboard.table.total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($recentOrders as $order)
                        <tr class="border-b">
                            <td class="py-2 font-semibold">#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? __('admin.dashboard.unknown_customer') }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>€{{ number_format($order->total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-500">
                                {{ __('admin.dashboard.no_recent_orders') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/chart.js') }}"></script>
@endpush