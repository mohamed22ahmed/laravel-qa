<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{ 
    protected $fillable=['body','user_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function votes(){
        return $this->morphByMany(User::class, 'votable');
    }

    public function getCreatedDateAttribute(){
        // diffForHumans ==> this for show the date as 2 days ago for examble
        // to show the date itself use the method format("d/m/y");
        return $this->created_at->diffForHumans();
    }
    
    public function getBodyHtmlAttribute(){
        // to convert text to its html format
        return clean(\Parsedown::instance()->text($this->body));
    }

    public static function boot(){
        parent::boot();
        static::created(function($answer){
            $answer->question->increment('answers_count');
        });
        static::deleted(function($answer){
            $answer->question->decrement('answers_count');
        });
    }
    
    public function makeItAccepted(Question $question){
        if($this->id==$question->best_answer_id)
            return 'vote-accepted';
    }
}
