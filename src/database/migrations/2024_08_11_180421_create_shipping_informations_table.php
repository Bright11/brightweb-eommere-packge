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
        Schema::create('shipping_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paymentid')->nullable();
            $table->foreign('paymentid')->references('id')->on('payments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("purpose")->nullable();
            $table->longText("message");
            $table->boolean("is_read")->defualt(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_informations');
    }
};
