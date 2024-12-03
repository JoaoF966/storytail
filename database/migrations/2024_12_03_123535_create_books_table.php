<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_url');
            $table->integer('read_time')->nullable();
            $table->unsignedBigInteger('age_group_id');
            $table->boolean('is_active')->default(true);
            $table->integer('access_level');
            $table->timestamps();
    
            $table->foreign('age_group_id')->references('id')->on('age_groups');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
    
};
