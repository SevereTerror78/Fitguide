<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advices', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['underweight', 'normal', 'overweight', 'obese']);
<<<<<<< HEAD
<<<<<<< HEAD
            $table->text('content');

=======
            $table->text('content')->nullable();
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            $table->timestamps();

            // Opcionális – ha 1 user + 1 kategória max 1 sor
            // $table->unique(['user_id', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advices');
    }
};
