<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('title');
            $table->string('video_url');
            $table->timestamps();
    
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
    
};
