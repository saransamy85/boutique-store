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

        $table->string('order_number')->unique();

        // Customer Details
        $table->string('customer_name');
        $table->string('email');
        $table->string('phone');

        // Shipping Address
        $table->text('address');
        $table->string('city');
        $table->string('state');
        $table->string('pincode');

        // Amount Details
        $table->decimal('subtotal', 10, 2);
        $table->decimal('shipping_charge', 10, 2)->default(0);
        $table->decimal('total_amount', 10, 2);

        // Payment Details
        $table->string('payment_method')->default('pending');
        $table->string('payment_status')->default('pending');

        // Order Status
        $table->string('order_status')->default('pending');

        $table->text('notes')->nullable();

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
