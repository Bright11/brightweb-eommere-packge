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
        Schema::create('coupon_balancs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The ID of the user who used the referral link
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_before_coupon', 10, 2);
            $table->decimal('total_after_coupon', 10, 2);
            $table->string("coupon");
            $table->decimal('discount_percentage', 5, 2)->nullable(); // Percentage discount
            $table->string("is_used")->default("pending");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_balancs');
    }
};
