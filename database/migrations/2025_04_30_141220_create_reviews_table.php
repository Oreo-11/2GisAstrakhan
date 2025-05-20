<?php

use App\Models\Restaurant;
use App\Models\User;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->engine('InnoDB');

            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->id();
            $table->foreignIdFor(Restaurant::class, 'restaurant_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();;
            $table->foreignIdFor(User::class, 'user_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();;
            $table->text('content');
            $table->integer('rate');

            $table->timestamps();

            // $table->unique(['restaurant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
