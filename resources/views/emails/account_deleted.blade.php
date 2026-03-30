<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ __('emails.account_deleted.subject') }}</title>
</head>
<body style="margin:0;padding:0;background:#061428;font-family:Arial,Helvetica,sans-serif;">
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
            <td align="center" style="padding:26px 32px 10px;color:#ffffff;">
              <h1 style="margin:0;font-size:24px;font-weight:700;">
                {{ __('emails.account_deleted.title') }}
              </h1>

              <p style="margin:10px 0 0;font-size:14px;color:#c5d3f1;line-height:1.6;">
                {{ __('emails.account_deleted.text') }}
              </p>

              <p style="margin:12px 0 0;font-size:15px;color:#ffffff;font-weight:600;">
                {{ $name }}
              </p>
            </td>
          </tr>

          <tr>
            <td align="center" style="padding:8px 24px 28px;">
              <a href="{{ url('/') }}"
                 style="display:inline-block;background:#2f6ff5;color:#ffffff;
                 padding:11px 26px;border-radius:999px;font-size:14px;text-decoration:none;font-weight:600;">
                {{ __('emails.account_deleted.cta') }}
              </a>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>