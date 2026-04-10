@extends('admin.layout')

@section('content')
<div class="p-6">
  {{-- HEADER --}}
  <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-5">
    <div>
      <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.notifications.title') }}</h1>
      <p class="text-sm text-gray-500">{{ __('admin.notifications.subtitle') }}</p>
    </div>

    <div class="flex items-center gap-3">
      <div class="text-sm text-gray-700">
        {{ __('admin.notifications.unread') }}:
        <span class="inline-flex items-center justify-center min-w-[22px] h-[22px] px-2 rounded-full bg-red-100 text-red-700 font-semibold">
          {{ $unreadCount }}
        </span>
      </div>

      <form method="POST" action="{{ route('admin.notifications.readAll') }}">
        @csrf
        <button type="submit"
                class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition shadow-sm">
          {{ __('admin.notifications.mark_all_read') }}
        </button>
      </form>
    </div>
  </div>

  {{-- LIST --}}
  <div class="space-y-4">
    @forelse($notifications as $n)
      @php
        $isUnread = is_null($n->read_at);

        $type = $n->type ?? 'general';

        $accent = match($type) {
          'low_stock'  => 'bg-red-500',
          'order_new'  => 'bg-blue-500',
          'order_paid' => 'bg-green-500',
          default      => 'bg-gray-400'
        };

        $badge = match($type) {
          'low_stock'  => 'bg-red-100 text-red-700',
          'order_new'  => 'bg-blue-100 text-blue-700',
          'order_paid' => 'bg-green-100 text-green-700',
          default      => 'bg-gray-100 text-gray-700'
        };

        // Fordított típus label (ha nincs kulcs, visszaesik a raw type-ra)
        $typeLabel = __('admin.notifications.types.' . $type);
        if ($typeLabel === 'admin.notifications.types.' . $type) {
          $typeLabel = strtoupper(str_replace('_', ' ', $type));
        }
      @endphp

      <div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        {{-- BAL ACCENT CSÍK --}}
        <div class="absolute left-0 top-0 h-full w-1.5 {{ $accent }}"></div>

        <div class="p-5 pl-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
          {{-- CONTENT --}}
          <div class="min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
              @if($isUnread)
                <span class="inline-flex items-center gap-2 text-xs font-semibold bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                  {{ __('admin.notifications.badges.unread') }}
                </span>
              @endif

              <span class="inline-flex items-center text-xs font-semibold px-2 py-1 rounded-full {{ $badge }}">
                {{ $typeLabel }}
              </span>
            </div>

            <p class="text-sm text-gray-700 mt-2">
              {{ $n->message }}
            </p>

            {{-- META --}}
            <div class="mt-3 flex flex-wrap items-center gap-2 text-xs">
              @if($n->product_id)
                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 text-gray-700">
                  {{ __('admin.notifications.meta.stock') }}:
                  <strong class="text-gray-900">{{ $n->stock }}</strong>
                </span>
                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 text-gray-700">
                  {{ __('admin.notifications.meta.threshold') }}:
                  <strong class="text-gray-900">{{ $n->threshold }}</strong>
                </span>
              @endif

              <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-gray-50 text-gray-500 border border-gray-200">
                {{ $n->created_at->format('Y-m-d H:i') }}
              </span>
            </div>
          </div>

          {{-- ACTIONS --}}
          <div class="flex items-center gap-2 shrink-0">
            @if($n->product_id)
              <a href="{{ route('admin.products.edit', $n->product_id) }}"
                 class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 transition shadow-sm">
                {{ __('admin.notifications.actions.view_product') }}
              </a>
            @endif

            @if($isUnread)
              <form method="POST" action="{{ route('admin.notifications.read', $n->id) }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition shadow-sm">
                  {{ __('admin.notifications.actions.mark_read') }}
                </button>
              </form>
            @else
              <span class="text-xs text-gray-400 px-2">{{ __('admin.notifications.badges.read') }}</span>
            @endif
          </div>
        </div>
      </div>

    @empty
      <div class="rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center">
        <div class="text-gray-900 font-semibold">{{ __('admin.notifications.empty.title') }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ __('admin.notifications.empty.subtitle') }}</div>
      </div>
    @endforelse
  </div>

  <div class="mt-6">
    {{ $notifications->links() }}
  </div>
</div>
@endsection