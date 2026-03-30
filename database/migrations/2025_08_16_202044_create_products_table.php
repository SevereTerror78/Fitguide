<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
<<<<<<< HEAD
<<<<<<< HEAD
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
=======
=======
>>>>>>> 5c55d34 (new features)
            $table->string('name_hu');

            $table->text('description')->nullable();
            $table->text('description_hu')->nullable();

            $table->unsignedInteger('price_huf');
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            $table->string('image')->nullable();

            $table->unsignedInteger('stock')->default(100);
            $table->boolean('is_active')->default(true);

            $table->foreignId('product_type_id')
                  ->nullable()
                  ->constrained('product_types')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
