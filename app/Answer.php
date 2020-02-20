<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function getBodyHtmlAttribute(){
        // to convert text to its html format
        return \Parsedown::instance()->text($this->body);
    }
}
