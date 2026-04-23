<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();

            $table->string('type'); // pl: low_stock
            $table->string('title');
            $table->text('message')->nullable();
            
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->unsignedInteger('stock')->nullable();
            $table->unsignedInteger('threshold')->nullable();

            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['type', 'read_at']);
            $table->index('product_id');
            

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};
