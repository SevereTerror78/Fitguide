<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ __('emails.order.subject') }}</title>
</head>
<body style="margin:0;padding:0;background:#061428;font-family:Arial,Helvetica,sans-serif;">
  @php
    $currency = $order->user?->currency ?? 'HUF';

    $formatMoney = function ($amountHuf) use ($currency) {
        if ($currency === 'EUR') {
            $eur = round($amountHuf / 381, 2);
            return '€' . number_format($eur, 2, '.', ' ');
        }

        return number_format($amountHuf, 0, ',', ' ') . ' Ft';
    };
  @endphp

  <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center" style="padding:24px 12px;">

        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
               style="max-width:580px;background:#081a33;border-radius:16px;overflow:hidden;">

          <tr>
            <td align="center" style="padding:18px 24px;background:#0b2445;">
              <span style="font-size:22px;font-weight:700;color:#ffffff;">FitGuide</span>
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:22px 24px 8px;">
              <div style="width:64px;height:64px;border-radius:50%;background:#2f9c4f;
                          line-height:64px;font-size:30px;color:#ffffff;">
                ✓
              </div>
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:4px 32px 10px;color:#ffffff;">
              <h1 style="margin:0;font-size:22px;font-weight:700;">
                {{ __('emails.order.title') }}
              </h1>
              @php
                $messageKey = match($order->payment_method) {
                    'card' => 'emails.order.card',
                    'cod' => 'emails.order.cod',
                    'pickup' => 'emails.order.pickup',
                    default => 'emails.order.processing'
                };
                @endphp

                <p style="margin:6px 0 0;font-size:14px;color:#c5d3f1;">
                    {{ __($messageKey) }}
                    <strong>#{{ $order->id }}</strong>
                </p>
            </td>
          </tr>

          <tr>
            <td style="padding:0 24px 18px;">
              <table width="100%" cellpadding="0" cellspacing="0" style="background:#0e2342;
                     border-radius:12px;padding:18px;color:#e3ecff;font-size:14px;">

                @foreach ($order->items as $item)
                <tr>
                  <td style="padding:10px 0;">
                    <div style="font-weight:600;">{{ $item->name }}</div>
                    <div style="font-size:12px;opacity:0.8;margin-top:3px;">
                      {{ $item->qty }} × {{ $formatMoney($item->unit_price) }}
                    </div>
                  </td>
                  <td align="right" style="padding:10px 0;font-weight:600;">
                    {{ $formatMoney($item->line_total) }}
                  </td>
                </tr>
                <tr><td colspan="2" style="border-bottom:1px solid rgba(255,255,255,0.08);"></td></tr>
                @endforeach

                <tr>
                  <td style="padding:12px 0;opacity:0.9;">{{ __('emails.order.subtotal') }}</td>
                  <td align="right" style="padding:12px 0;font-weight:600;">
                    {{ $formatMoney($order->subtotal) }}
                  </td>
                </tr>
                <tr>
                  <td style="padding:6px 0;opacity:0.9;">{{ __('emails.order.shipping') }}</td>
                  <td align="right" style="padding:6px 0;font-weight:600;">
                    {{ $formatMoney($order->shipping) }}
                  </td>
                </tr>
                <tr>
                  <td style="padding-top:14px;font-weight:700;font-size:16px;">{{ __('emails.order.total') }}</td>
                  <td align="right" style="padding-top:14px;font-weight:700;font-size:16px;">
                    {{ $formatMoney($order->total) }}
                  </td>
                </tr>

              </table>
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:0 24px 26px;">
              <a href="{{ route('orders.show', $order->id) }}"
                 style="display:inline-block;background:#2f6ff5;color:#ffffff;
                 padding:11px 26px;border-radius:999px;font-size:14px;text-decoration:none;font-weight:600;">
                {{ __('emails.order.view_order') }}
              </a>
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>
</body>
</html>