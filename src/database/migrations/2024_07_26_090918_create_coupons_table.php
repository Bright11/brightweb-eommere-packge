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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('usage_count')->default(0);
            $table->boolean('one_time_use')->default(false);
            //$table->decimal('discount_amount', 10, 2)->nullable(); // Fixed amount discount
            $table->decimal('discount_percentage', 5, 2)->nullable(); // Percentage discount
            $table->date('expires_at');
            $table->string("status")->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
