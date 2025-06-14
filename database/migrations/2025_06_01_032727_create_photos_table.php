<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id('photo_id');
            $table->string('caption')->nullable();

            $table->unsignedBigInteger('user_id');
            // Foreign key to users table
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            
            $table->string('image_path'); // to store the photo file name
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
