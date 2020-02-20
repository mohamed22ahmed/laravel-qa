<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug($value);
    }

    /*
      accessors for Question 
      accessor format is 
      getNameAttribute ==> where Name is the attribute name
    */
    public function getUrlAttribute(){
        return route('questions.show',$this->id);
    }

    public function getCreatedDateAttribute(){
        // diffForHumans ==> this for show the date as 2 days ago for examble
        // to show the date itself use the method format("d/m/y");
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count>0){
            if($this->best_answer_id)
                return 'answered-accepted';
            return "answered";
        }
        return 'unanswered';
    }

    public function getBodyHtmlAttribute(){
        // to convert text to its html format
        return \Parsedown::instance()->text($this->body);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
