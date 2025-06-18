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
        Schema::create('saved_photos', function (Blueprint $table) {
    $table->id();

    // Sesuaikan dengan kolom di tabel users dan photos
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('photo_id');

    $table->timestamps();

    // Foreign key mengarah ke kolom yang benar
    $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    $table->foreign('photo_id')->references('photo_id')->on('photos')->onDelete('cascade');
});
}

           

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_photos');
    }
};
