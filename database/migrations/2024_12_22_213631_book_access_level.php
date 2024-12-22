<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "update `books` set `access_level` = 'premium' where `access_level` = 1"
        );
        DB::statement(
            "update `books` set `access_level` = 'free' where `access_level` <> 'premium'"
        );
        DB::statement(
            "alter table `books` modify `access_level` ENUM('premium', 'free') NOT NULL DEFAULT 'free';"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Unrevertable migration
    }
};