<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;
    
    public function updateAnswer(User $user, Answer $answer){
        return $user->id == $answer->user_id;
    }
    public function acceptAnswer(User $user, Answer $answer){
        return $user->id == $answer->question->user_id;
    }

    public function deleteAnswer(User $user, Answer $answer){
        return $user->id == $answer->user_id;
    }

}
