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
        Schema::create('services', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('price');
            $table->string('location');
            $table->string('category');
            $table->decimal('rating', 2, 1);
            $table->string('banner_alpha')->nullable();
            $table->string('banner_beta')->nullable();
            $table->string('banner_gama')->nullable();
            $table->json('offers');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
