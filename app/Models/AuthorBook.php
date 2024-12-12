<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AuthorBook extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'author_book';
}
