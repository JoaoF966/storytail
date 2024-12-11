<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUserRead extends Model
{
    use HasFactory;


    protected $table = 'book_user_read';

    protected $fillable = [
        'book_id',
        'user_id',
        'progress',
        'rating',
        'read_date',
    ];


    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
