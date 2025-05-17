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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->engine('InnoDB');

            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->id();
            $table->string('title');
            $table->text('description');
            $table->time('worktime_start');
            $table->time('worktime_end');
            $table->string('phone');
            $table->string('restaurant_site_url');
            $table->string('address');
            $table->string('average_price');
            $table->double('coordX');
            $table->double('coordY');
            $table->string('owner_name');
            $table->string('owner_surname');
            $table->string('owner_patronymic');
            $table->string('restaurant_mail');
            $table->string('INN');
            $table->string('KPP');
            $table->string('OGRN');
            $table->string('telegram_url');
            $table->string('whatsapp_url');
            $table->string('vk_url');
            $table->tinyInteger('status');
            $table->float('rating')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
