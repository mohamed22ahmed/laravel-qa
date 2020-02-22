<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;

class AnswersController extends Controller
{
    public function store(Question $question){
        request()->validate([
            'body'=>'required',
        ]);
        $question->answers()->create(['body'=>request('body'),'user_id'=>\Auth::id()]);
        return back()->with('success','your answer has been submitted successfully');
    }
}
