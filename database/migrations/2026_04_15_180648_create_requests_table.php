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
    Schema::create('requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('room');                // помещение: аудитория, коворкинг, кинозал
        $table->date('date');                  // дата конференции
        $table->time('time');                  // время начала
        $table->string('payment_method');      // способ оплаты
        $table->string('phone');               // контактный телефон
        $table->enum('status', ['new', 'assigned', 'completed'])->default('new');
        $table->text('review')->nullable();    // отзыв (может быть пустым)
        $table->timestamps();
    });
}
};
