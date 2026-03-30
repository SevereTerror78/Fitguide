<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stripe_webhook_events', function (Blueprint $table) {
            $table->id();

            // Stripe event azonosító (pl. evt_...)
            $table->string('event_id')->unique();

            // pl: checkout.session.completed
            $table->string('type');

            // Melyik rendeléshez kötődött (ha volt)
            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->nullOnDelete();

            // Mikor dolgoztuk fel ténylegesen
            $table->timestamp('processed_at')->nullable();

            // Teljes Stripe payload (debug + audit)
            $table->json('payload')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stripe_webhook_events');
    }
};
