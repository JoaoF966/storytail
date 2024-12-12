<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TaggingTag extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tagging_tagged';
}
