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
        Schema::create('referral_usages', function (Blueprint $table) {
            $table->id();
            $table->string("userip");
            $table->string("referral_code")->uniqid();
            $table->string("status")->default("pending");
            $table->unsignedBigInteger('referrer_id'); // The ID of the user who used the referral link
            $table->unsignedBigInteger("referee_id")->nullable();
            $table->foreign('referrer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('referee_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_usages');
    }
};
