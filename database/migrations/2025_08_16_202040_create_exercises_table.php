<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
<<<<<<< HEAD
            $table->string('name');               // pl. Fekvenyomás
            $table->text('description')->nullable();
            $table->string('video_url');          // pl. YouTube link vagy saját fájl URL
=======
=======
>>>>>>> 5c55d34 (new features)

            $table->string('name');                 // EN name
            $table->string('name_hu')->nullable();  // HU name

            $table->text('description')->nullable();       // EN desc
            $table->text('description_hu')->nullable();    // HU desc

            $table->string('video_url');
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};