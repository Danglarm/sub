<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('plan'); // Название тарифного плана
        $table->decimal('price', 8, 2); // Стоимость подписки
        $table->timestamp('start_date')->nullable(); // Дата начала подписки
        $table->timestamp('end_date')->nullable(); // Дата окончания подписки
        $table->boolean('is_active')->default(true); // Активна ли подписка
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
