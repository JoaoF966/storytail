<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $sql = file_get_contents('/var/www/html/database/migrations/dumps/initial_skeleton.sql');
        DB::unprepared($sql);
    }

    public function down(): void
    {
        throw new Exception('This migration cannot be reversed.');
    }
};
