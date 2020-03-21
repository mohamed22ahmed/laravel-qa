<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    
    public function favorites(){
        // we specify the favorites table because the default name is question_user
        return $this->belongsToMany(Question::class, 'favorites')->withTimeStamps();
    }

    public function voteQuestions(){
        return $this->morphedByMany(Question::class, 'votable');
    }
    public function voteAnswers(){
        return $this->morphedByMany(Answer::class, 'votable');
    }
    
    public function rel(){
        return $this->morphedByMany(Answer::class, 'votable');
    }


    // accessors for user
    public function getUrlAttribute(){
        //return route('questions.show'.$this->id);
        return '#';
    }

    public function getAvatarAttribute(){
        // to get avatar photo go to gavatar.com and choose php
        $email=$this->email;
        $size=32;
        return "https://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?s=".$size;
    }

    // this function shows how the user votes the question
    public function voteQuestion(Question $question, $vote){
        $voteQuestions = $this->voteQuestions();
        $this->_vote($voteQuestions,$question,$vote);
    }

    // this function shows how the user votes the answer
    public function voteAnswer(Answer $answer, $vote){
        $voteAnswers = $this->voteAnswers();
        $this->_vote($voteAnswers,$answer,$vote);
    }

    private function _vote($rel, $model, $vote){
        if($rel->where('votable_id',$model->id)->exists())
            $rel->updateExistingPivot($model, ['vote'=>$vote]);
        else
            $rel->attach($model, ['vote'=>$vote]);
        $vote = $rel->where('votable_id',$model->id)->exists() ? $rel->where('votable_id',$model->id)->sum('vote') : 0;
        $model->votes_count = $vote;
        $model->save();
    }
}
