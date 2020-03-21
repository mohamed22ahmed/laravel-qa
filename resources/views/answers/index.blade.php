<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{$q->answers_count." ".str_plural('Answer',$q->answers_count)}}</h2>
                    </div>
                    <hr>
                    @foreach ($q->answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a 
                                class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault();document.getElementById('up-vote-answer-{{ $answer->id }}').submit()"
                                title="This answer is useful"
                                >
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form action="/answers/{{ $answer->id }}/vote" id="up-vote-answer-{{ $answer->id }}" method="post" style="display:none">
                                    @csrf     
                                    <input type="hidden" name="vote" value="1">
                                </form>

                                <span class="votes-count">{{ $answer->votes_count }}</span>

                                <a 
                                    title="This question is not useful" 
                                    class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                    onclick="event.preventDefault();document.getElementById('down-vote-answer-{{ $answer->id }}').submit()"
                                >
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form action="/answers/{{ $answer->id }}/vote" id="down-vote-answer-{{ $answer->id }}" method="post" style="display:none">
                                    @csrf     
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                @if ($answer->user_id == \Auth::id())
                                    <a 
                                        title="Click to mark as best answer (click again to undo)" 
                                        class="mt-2"
                                        onclick="event.preventDefault();document.getElementById('accept-answer-{{$answer->id}}').submit()"
                                    >
                                        <i class="fas fa-check fa-2x {{$answer->makeItAccepted($q)}}"></i>
                                        <span class="favorite-count">123</span>
                                    </a>
                                    <form action="{{ route('answers.accept',$answer->id) }}" id="accept-answer-{{$answer->id}}" method="post" style="display:none">
                                        @csrf
                                    </form>
                                @else
                                        @if($answer->question->best_answer_id == $answer->id)
                                            <a title="Click to mark as best answer (click again to undo)" class="mt-2">
                                            <i class="fas fa-check fa-2x {{$answer->makeItAccepted($q)}}"></i>
                                        @endif
                                @endif
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @if ($answer->user_id == \Auth::id())
                                                <a href='{{url("question/$q->id/answers/$answer->id/edit") }}' class="btn btn-sm btn-outline-info">Edit</a>
                                                <a href='{{url("answers/$answer->id/delete") }}' class="btn btn-sm btn-outline-danger" onclick="return confirm('are you sure')">Delete</a>                               
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-4">
                                        <span class="text-muted">
                                            Answered {{ $answer->created_date }}
                                        </span>
                                        <div class="media mt-2">
                                            <a href="{{$answer->user->url}}" class="pr-2">
                                                <img src="{{$answer->user->avatar}}">
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{$answer->user->url}}">
                                                    {{$answer->user->name}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>