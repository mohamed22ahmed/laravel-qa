<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['title','body'];

    // Relations:
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class)->orderBy('votes_count','DESC');
    }
    
    public function favorites(){
        // to make the created at and updated at have a value not null
        return $this->belongsToMany(User::class, 'favorites')->withTimeStamps();
    }

    public function votes(){
        return $this->morphedByMany(User::class, 'votable');
    }

    // accessors for Question ==> Set Attributes
    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug($value);
    }


    /*
      accessors for Question ==> Get Attributes 
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
        return clean(\Parsedown::instance()->text($this->body));
    }

    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function getIsFavoritedAttribute(){
        return $this->favorites()->where('user_id',auth()->id())->count()>0;
    }
    
    public function getFavoritesCountAttribute(){
        return $this->favorites->count();
    }
}
