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
        Schema::create('photo_user', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('photo_id');
    $table->timestamps();

    $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    $table->foreign('photo_id')->references('photo_id')->on('photos')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_user');
    }
};
