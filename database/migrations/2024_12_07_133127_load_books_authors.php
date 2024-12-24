<?php

namespace database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $sql = file_get_contents('/var/www/html/database/migrations/dumps/books_author_seeds.sql');
        DB::unprepared($sql);
    }

    public function down(): void
    {
        DB::unprepared('truncate table `author_book`;');
        DB::unprepared('truncate table `books`;');
        DB::unprepared('truncate table `authors`;');
        DB::unprepared('truncate table `age_groups`;');
    }
};
