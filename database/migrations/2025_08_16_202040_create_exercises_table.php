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
            $table->string('name');               // pl. Fekvenyomás
            $table->text('description')->nullable();
            $table->string('video_url');          // pl. YouTube link vagy saját fájl URL
=======

            $table->string('name');                 // EN name
            $table->string('name_hu')->nullable();  // HU name

            $table->text('description')->nullable();       // EN desc
            $table->text('description_hu')->nullable();    // HU desc

            $table->string('video_url');
>>>>>>> fc7673c (frontend update and some new feature)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};