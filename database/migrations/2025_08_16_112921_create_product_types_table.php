<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();          // pl. "Supplements", "Snacks"
<<<<<<< HEAD
=======
             $table->string('name_hu')->nullable(); 
>>>>>>> fc7673c (frontend update and some new feature)
            $table->string('slug')->unique();          // pl. "supplements"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_types');
    }
};
