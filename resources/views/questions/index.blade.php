@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    {{--  str_plural => it uses for make the word single or plural جمع --}}
                                    <strong>{{$question->votes }}</strong> {{ str_plural('vote',$question->votes) }}
                                </div>
                                <div class="status {{$question->status}}">
                                    <strong>{{$question->answers }}</strong> {{ str_plural('answer',$question->answers) }}
                                </div>
                                <div class="view">
                                    {{$question->views.' '.  str_plural('view',$question->views) }}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    {{--  
                                        we can use route('question.show',$question->id) inside the h3 tag below
                                        instead of make it in Question model like:
                                        public function getUrlAttribute(){
                                            return route('questions.show'.$this->id);
                                        }    
                                        and use inside h3 tag below the property ' url' instead
                                    --}}
                                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                    <div class="ml-auto">
                                        @if(Auth::user()->can('update_question',$question))
                                            <a href="{{route('questions.edit',$question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endif
                                        @if(Auth::user()->can('delete_question',$question))
                                            <form style="display:inline" action="{{route('questions.destroy',$question->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('are you sure')">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                
                                <p class="lead">
                                    Asked by 
                                    <a href="{{ $question->user->url}}">{{ $question->user->name}}</a>
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                    {{ str_limit($question->body,250) }}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div>
                        {{ $questions->links() }} {{--  to make pagination buttons  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
