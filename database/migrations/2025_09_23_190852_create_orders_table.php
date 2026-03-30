<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // ───── Kapcsolatok
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /**
             * ───── Régi status (megtartva kompatibilitás miatt)
             * cart | pending_payment | paid | failed | cancelled
             *
             * (Később akár ki is vezetheted, ha már minden az új mezőket használja.)
             */
            $table->string('status', 30)->default('cart')->index();

            // ───── ÚJ: fizetési mód + fizetés státusz + teljesítés státusz
            // payment_method: card | cod | pickup
            $table->string('payment_method', 20)->default('card')->index();

            // payment_status: unpaid | pending | paid | failed | refunded
            $table->string('payment_status', 20)->default('unpaid')->index();

            // fulfillment_status: new | processing | shipped | delivered | ready_for_pickup | completed | cancelled
            $table->string('fulfillment_status', 30)->default('new')->index();

            // ───── Pénznem + összegek
            $table->string('currency', 3)->default('EUR');

            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            // ───── Stripe / fizetés
            $table->string('stripe_checkout_session_id')->nullable()->index();
            $table->string('stripe_payment_intent_id')->nullable()->index();

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('payment_failed_at')->nullable();
            $table->text('payment_last_error')->nullable();

            // ───── Teljesítés / kiszállítás/átadás
            $table->timestamp('fulfilled_at')->nullable()->index();

            // ───── Pontjóváírás védelem
            $table->boolean('points_awarded')->default(false);
            $table->timestamp('points_awarded_at')->nullable();

            // ───── Szállítási adatok
            // Pickup esetén ezek ne legyenek kötelezők.
            $table->string('full_name');

            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            // ───── Pickup extra (opcionális)
<<<<<<< HEAD
<<<<<<< HEAD
            $table->string('pickup_location')->nullable();
=======
            $table->string('pickup_location', 100)->nullable()->index();
>>>>>>> fc7673c (frontend update and some new feature)
=======
            $table->string('pickup_location', 100)->nullable()->index();
>>>>>>> 5c55d34 (new features)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
