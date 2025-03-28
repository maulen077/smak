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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('guest_id');
            $table->string('name');
            $table->string('phone');
            $table->enum('delivery_type', ['delivery', 'pickup']);
            $table->string('address');
            $table->text('comment')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('total_price')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
