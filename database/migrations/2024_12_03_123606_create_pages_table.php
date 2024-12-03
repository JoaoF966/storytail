<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('page_image_url');
            $table->string('audio_uri')->nullable();
            $table->integer('page_index');
            $table->timestamps();
    
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
    
};
