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

    public function edit(Question $question, Answer $answer,$id,$qid){
        // $this->authorize('update',$answer);
        $answer=Answer::find($qid);
        $question=Question::find($id);
        return view('answers.edit',compact('question','answer'));
    }

    public function update(Request $request, Answer $answer,$qid,$id){
        //$this->authorize('update',$answer);
        $answer=Answer::find($id);
        $answer->update($request->validate([
            'body'=>'required',
        ]));
        return redirect()->route('questions.show', $qid)->with('success','Your answer has been updated successfully');
    }

    public function destroy(Answer $answer,$id){
        //$this->authorize('delete',$answer);
        $answer=Answer::find($id);
        $answer->delete();
        return redirect()->back()->with('success','Your answer has been deleted successfully');
    }
}
