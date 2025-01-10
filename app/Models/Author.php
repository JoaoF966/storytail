<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function completeName(): string {
        return $this->first_name . ' ' . $this->last_name;
    }
}
