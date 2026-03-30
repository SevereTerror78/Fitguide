<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // 🔥 User role (admin / user)
            $table->enum('role', ['user', 'admin'])->default('user');

            // ✅ SETTINGS
            $table->string('language', 5)->default('hu');     // hu | en
            $table->string('theme', 20)->default('dark');     // light | dark | colorblind
            $table->string('currency', 5)->default('HUF');    // HUF | EUR | USD

            // 🔥 PROFIL MEZŐK
<<<<<<< HEAD
<<<<<<< HEAD
            $table->string('profile_picture')->nullable();
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();

            // ⭐ Reward pontok
            $table->integer('points')->default(0);

            // ⭐ Egyszeri bónuszok (hogy NE kapja meg többször)
            $table->boolean('first_login_bonus_claimed')->default(false);   // +75 egyszer
            $table->boolean('profile_bonus_claimed')->default(false);       // +25 egyszer

            // (opcionális) ha akarod látni, mikor történt
            $table->timestamp('first_login_bonus_claimed_at')->nullable();
            $table->timestamp('profile_bonus_claimed_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // ✔ AUTOMATIKUS ADMIN FIÓK
        DB::table('users')->insert([
            'name'              => 'Admin',
            'email'             => 'admin@fitguide.com',
            'password'          => Hash::make('admin123'),
            'role'              => 'admin',
            'email_verified_at' => now(),

            // ✅ SETTINGS default az adminnak is
            'language'          => 'hu',
            'theme'             => 'dark',
            'currency'          => 'HUF',

<<<<<<< HEAD
<<<<<<< HEAD
            'profile_picture'   => null,
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            'phone'             => null,
            'dob'               => null,
            'gender'            => null,
            'points'            => 75,
            'first_login_bonus_claimed' => false,
            'profile_bonus_claimed'     => false,
            'first_login_bonus_claimed_at' => null,
            'profile_bonus_claimed_at'     => null,

            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
