<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('muscles', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD

            $table->string('name')->unique();

            $table->string('name')->unique();        // EN name
            $table->string('name_hu')->nullable();   // HU name

=======
            $table->string('name')->unique();        // EN name
            $table->string('name_hu')->nullable();   // HU name
>>>>>>> 5c55d34 (new features)
            $table->string('slug')->unique();
            $table->enum('category', ['arm', 'body', 'leg']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('muscles');
    }
<<<<<<< HEAD
};
=======
};
>>>>>>> 5c55d34 (new features)
