<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function __construct(){
        // if any user try to ask, edit, update, delete question without login
        // the middleware redirect him to login page
        $this->middleware('auth')->except(['index','show']);
    }
    public function index()
    {
        /*
            to reduce the number of queries and time of loading data use :
            with('user') ==> user is the relation method set in question model
        */ 
        $questions=Question::with('user')->latest()->paginate(5);//to show 5 questions per page
        return view('questions.index',compact('questions'));
    }

    public function create()
    {
        $question=new Question();
        return view('questions.create',compact('question'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'body'=>'required',
        ]);
        //to store the question using create method & when being a relation use:
        $request->user()->questions()->create($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','your question has been submitted');
    }

    public function show(Question $question)
    {
        // to increment integer element use increment instead of ++
        $question->increment('views');
        $q=Question::find($question->id);
        return view('questions.show',compact('q'));
    }

    public function edit(Question $question)
    {
        $this->authorize('delete',$question);
        return view('questions.edit',compact('question'));
    }

    public function update(Request $request, Question $question)
    {        
        $this->authorize('delete',$question);
        $request->validate([
            'title'=>'required|max:255',
            'body'=>'required',
        ]);
        $question->update($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','Question updated successfully');
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete',$question);
        $question->delete();
        return redirect()->route('questions.index')->with('success','the question has been deleted successfully');
    }
}
