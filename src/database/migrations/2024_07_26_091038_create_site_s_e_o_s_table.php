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
        Schema::create('site_s_e_o_s', function (Blueprint $table) {
            $table->id();
            $table->string("site_title");
            $table->string("site_logo");
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            // $table->string('meta_robots')->nullable();
            $table->string('twitter_title')->nullable();
            $table->longText('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('og_title')->nullable();
            $table->longText('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_s_e_o_s');
    }
};
