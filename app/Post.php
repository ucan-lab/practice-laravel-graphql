<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
