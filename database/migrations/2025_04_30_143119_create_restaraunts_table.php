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
        Schema::create('restaraunts', function (Blueprint $table) {
            $table->engine('InnoDB');

            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->id();
            $table->string('title');
            $table->string('description');
            $table->timestamp('worktime_start');
            $table->timestamp('worktime_end');
            $table->string('phone');
            $table->string('restaraunt_site_url');
            $table->string('address');
            $table->string('average_price');
            $table->double('coordX');
            $table->double('coordY');
            $table->string('owner_name');
            $table->string('owner_surname');
            $table->string('owner_patronymic');
            $table->string('restaraunt_mail');
            $table->integer('INN');
            $table->integer('KPP');
            $table->integer('OGRN');
            $table->string('telegram_url');
            $table->string('whatsApp_url');
            $table->string('vk_url');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaraunts');
    }
};
