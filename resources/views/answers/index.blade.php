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
                                <a class="vote-up" title="This answer is useful">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">1230</span>
                                <a title="This answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="Click to mark as best answer (click again to undo)" class="mt-2">
                                    <i class="fas fa-check fa-2x vote-accepted"></i>
                                    <span class="favorite-count">123</span>
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @if(Auth::user())
                                                @if(Auth::user()->can('update',$answer))
                                                  <a href='{{url("question/$q->id/answers/$answer->id/edit") }}' class="btn btn-sm btn-outline-info">Edit</a>
                                                @endif
                                            @endif
                                            @if(Auth::user())
                                                @if(Auth::user()->can('delete',$answer))
                                                <a href='{{url("answers/$answer->id/delete") }}' class="btn btn-sm btn-outline-danger" onclick="return confirm('are you sure')">Delete</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">

                                    </div>
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