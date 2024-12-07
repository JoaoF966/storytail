<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('alter table books add column featured_at datetime default null');
    }

    public function down(): void
    {
        DB::statement('alter table books drop column featured_at');
    }

};
