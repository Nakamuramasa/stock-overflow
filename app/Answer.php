<?php

namespace App;

use Parsedown;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        $parse = new Parsedown();
        return $parse->text($this->body);
    }
}
