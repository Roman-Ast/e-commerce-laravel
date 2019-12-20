<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Get the reply for the comment.
     */
    public function subcomments()
    {
        return $this->hasMany('App\SubComment');
    }
}
