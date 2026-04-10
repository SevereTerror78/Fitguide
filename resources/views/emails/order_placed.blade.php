<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your FitGuide Order</title>
</head>
<body style="margin:0;padding:0;background:#061428;font-family:Arial,Helvetica,sans-serif;">
<<<<<<< HEAD
=======
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

>>>>>>> fc7673c (frontend update and some new feature)
  <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center" style="padding:24px 12px;">

        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
               style="max-width:580px;background:#081a33;border-radius:16px;overflow:hidden;">

<<<<<<< HEAD
          <!-- HEADER -->
=======
>>>>>>> fc7673c (frontend update and some new feature)
          <tr>
            <td align="center" style="padding:18px 24px;background:#0b2445;">
              <span style="font-size:22px;font-weight:700;color:#ffffff;">FitGuide</span>
            </td>
          </tr>

<<<<<<< HEAD
          <!-- ICON -->
=======
>>>>>>> fc7673c (frontend update and some new feature)
          <tr>
            <td align="center" style="padding:22px 24px 8px;">
              <div style="width:64px;height:64px;border-radius:50%;background:#2f9c4f;
                          line-height:64px;font-size:30px;color:#ffffff;">
                ✓
              </div>
            </td>
          </tr>

<<<<<<< HEAD
          <!-- TITLE -->
=======
>>>>>>> fc7673c (frontend update and some new feature)
          <tr>
            <td align="center" style="padding:4px 32px 10px;color:#ffffff;">
              <h1 style="margin:0;font-size:22px;font-weight:700;">
                Thank you for your order!
              </h1>
              <p style="margin:6px 0 0;font-size:14px;color:#c5d3f1;">
                Your order <strong>#{{ $order->id }}</strong> is now being processed.
              </p>
            </td>
          </tr>

<<<<<<< HEAD
          <!-- ORDER ITEMS -->
=======
>>>>>>> fc7673c (frontend update and some new feature)
          <tr>
            <td style="padding:0 24px 18px;">
              <table width="100%" cellpadding="0" cellspacing="0" style="background:#0e2342;
                     border-radius:12px;padding:18px;color:#e3ecff;font-size:14px;">
                
                @foreach ($order->items as $item)
                <tr>
                  <td style="padding:10px 0;">
                    <div style="font-weight:600;">{{ $item->name }}</div>
                    <div style="font-size:12px;opacity:0.8;margin-top:3px;">
<<<<<<< HEAD
                      {{ $item->qty }} × €{{ number_format($item->unit_price, 2) }}
                    </div>
                  </td>
                  <td align="right" style="padding:10px 0;font-weight:600;">
                    €{{ number_format($item->line_total, 2) }}
=======
                      {{ $item->qty }} × {{ $formatMoney($item->unit_price) }}
                    </div>
                  </td>
                  <td align="right" style="padding:10px 0;font-weight:600;">
                    {{ $formatMoney($item->line_total) }}
>>>>>>> fc7673c (frontend update and some new feature)
                  </td>
                </tr>
                <tr><td colspan="2" style="border-bottom:1px solid rgba(255,255,255,0.08);"></td></tr>
                @endforeach

<<<<<<< HEAD
                <!-- Summary -->
                <tr>
                  <td style="padding:12px 0;opacity:0.9;">Subtotal</td>
                  <td align="right" style="padding:12px 0;font-weight:600;">
                    €{{ number_format($order->subtotal, 2) }}
=======
                <tr>
                  <td style="padding:12px 0;opacity:0.9;">Subtotal</td>
                  <td align="right" style="padding:12px 0;font-weight:600;">
                    {{ $formatMoney($order->subtotal) }}
>>>>>>> fc7673c (frontend update and some new feature)
                  </td>
                </tr>
                <tr>
                  <td style="padding:6px 0;opacity:0.9;">Shipping</td>
                  <td align="right" style="padding:6px 0;font-weight:600;">
<<<<<<< HEAD
                    €{{ number_format($order->shipping, 2) }}
=======
                    {{ $formatMoney($order->shipping) }}
>>>>>>> fc7673c (frontend update and some new feature)
                  </td>
                </tr>
                <tr>
                  <td style="padding-top:14px;font-weight:700;font-size:16px;">Total</td>
                  <td align="right" style="padding-top:14px;font-weight:700;font-size:16px;">
<<<<<<< HEAD
                    €{{ number_format($order->total, 2) }}
=======
                    {{ $formatMoney($order->total) }}
>>>>>>> fc7673c (frontend update and some new feature)
                  </td>
                </tr>

              </table>
            </td>
          </tr>

<<<<<<< HEAD
          <!-- DETAILS BUTTON -->
=======
>>>>>>> fc7673c (frontend update and some new feature)
          <tr>
            <td align="center" style="padding:0 24px 26px;">
              <a href="{{ route('orders.show', $order->id) }}"
                 style="display:inline-block;background:#2f6ff5;color:#ffffff;
                 padding:11px 26px;border-radius:999px;font-size:14px;text-decoration:none;font-weight:600;">
                VIEW ORDER DETAILS
              </a>
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> fc7673c (frontend update and some new feature)
