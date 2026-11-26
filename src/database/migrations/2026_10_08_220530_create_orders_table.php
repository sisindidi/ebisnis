<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained()->onDelete('cascade');
            $table->string('order_code')->unique();
            $table->enum('order_type', ['solo', 'group'])->default('solo');
            $table->enum('service_type', ['dine_in', 'take_away'])->default('dine_in');
            $table->integer('total_price');
            $table->enum('status', ['pending', 'paid', 'cooking', 'ready', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};