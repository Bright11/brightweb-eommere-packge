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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payer_name');
            $table->string('payment_id');
            $table->decimal('paid_amount', 8, 2);
            $table->string('payment_type');
            $table->string('currency');
            $table->string('payment_status');
            $table->string("payment_channel")->nullable(true);
            $table->string("bank")->nullable(true);
            $table->string("card_type")->default("No card");
            $table->string("card_no")->nullable(true);
            $table->string("order_status")->default("pending");
            $table->boolean('is_emailed')->default(false);
            $table->string("is_received")->default("false");
            $table->decimal('discount_amount', 10, 2)->nullable(); // Fixed amount discount
            $table->decimal('discount_percentage', 5, 2)->nullable(); // Percentage discount
            $table->string('couponcode')->nullable(); // Promo code ID
            $table->decimal("original_price",10,2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
