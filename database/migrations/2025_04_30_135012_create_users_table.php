<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine('InnoDB');

            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('login');
            $table->string('password');
            $table->string('email');
            $table->integer('age');
            $table->tinyInteger('sex');
            $table->tinyInteger('status');
            $table->string('reason');
            $table->string('src');
            $table->timestamp('last_entry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
