<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_CART = 'cart';
    public const STATUS_PENDING_PAYMENT = 'pending_payment';
    public const STATUS_PAID = 'paid';
    public const STATUS_FAILED = 'failed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',

        // legacy / compat
        'status',

        // ✅ új fizetési + fulfillment mezők
        'payment_method',
        'payment_status',
        'fulfillment_status',

        // pénznem + összegek
        'currency',
        'subtotal',
        'shipping',
        'total',

        // Stripe / fizetés mezők
        'stripe_checkout_session_id',
        'stripe_payment_intent_id',
        'paid_at',
        'payment_failed_at',
        'payment_last_error',

        // ✅ teljesítés védelem (készlet+email+pont csak egyszer)
        'fulfilled_at',

        // pont védelem
        'points_awarded',
        'points_awarded_at',

        // cím
        'full_name',
        'address_line1',
        'address_line2',
        'city',
        'postal_code',
        'country',

        // ✅ pickup extra
        'pickup_location',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',

        'points_awarded' => 'boolean',
        'points_awarded_at' => 'datetime',

        'paid_at' => 'datetime',
        'payment_failed_at' => 'datetime',

        // ✅
        'fulfilled_at' => 'datetime',
    ];
<<<<<<< HEAD
=======
    public const PICKUP_LOCATIONS = [
        'budapest' => 'Budapest – Váci út 23, 1132',
        'debrecen' => 'Debrecen – Piac utca 12, 4024',
        'miskolc'  => 'Miskolc – Széchenyi utca 45, 3525',
        'szeged'   => 'Szeged – Kárász utca 8, 6720',
        'gyor'     => 'Győr – Baross Gábor út 21, 9021',
    ];
>>>>>>> fc7673c (frontend update and some new feature)

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Pontot csak sikeres fizetés után (paid) adunk,
     * és csak egyszer (points_awarded védelem).
     *
     * FONTOS: nálad még a legacy status mezőt nézi.
     * Ha az új rendszert használod, ezt érdemes majd payment_status-ra átállítani.
     */
    public function awardPointsIfEligible(): void
    {
        if ($this->points_awarded) return;

        // ✅ marad a legacy logika: csak akkor ad, ha status = paid és paid_at nem null
        if ($this->status !== self::STATUS_PAID) return;
        if (is_null($this->paid_at)) return;

        $rate = 381;
        $hufTotal = (int) round(((float) $this->total) * $rate);

        // 1 pont / 400 Ft
        $points = max(1, intdiv($hufTotal, 400));

        $this->user->increment('points', $points);

        $this->forceFill([
            'points_awarded' => true,
            'points_awarded_at' => now(),
        ])->save();
    }

    /**
     * ✅ Ez fogja megakadályozni, hogy készlet/email/pont duplán menjen.
     */
    public function isFulfilled(): bool
    {
        return !is_null($this->fulfilled_at);
    }
}
