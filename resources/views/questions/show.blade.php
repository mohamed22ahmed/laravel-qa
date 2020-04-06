@extends('layouts.app')
@section('content')
<div class="container">
    @include('layouts._messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{$q->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Question</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">

                            <a
                                class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault();document.getElementById('up-vote-question-{{$q->id}}').submit()"
                                title="This question is useful"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form action="/questions/{{$q->id}}/vote" id="up-vote-question-{{$q->id}}" method="post" style="display:none">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count">{{ $q->votes_count }}</span>

                            <a
                                title="This question is not useful"
                                class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault();document.getElementById('down-vote-question-{{$q->id}}').submit()"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/questions/{{$q->id}}/vote" id="down-vote-question-{{$q->id}}" method="post" style="display:none">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <a
                                title="Click to mark as favorite question (click again to undo)"
                                class="mt-2 {{ Auth::guest() ? 'off': ($q->is_favorited ? 'favorite' : '') }}"
                                onclick="event.preventDefault();document.getElementById('favorite-question-{{$q->id}}').submit()"
                            >
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorite-count">{{$q->favorites_count}}</span>
                            </a>
                            @if($q->is_favorited)
                                <form action="/questions/{{$q->id}}/unfavorite" id="favorite-question-{{$q->id}}" method="post" style="display:none">
                                    @csrf
                                </form>
                            @else
                                <form action="/questions/{{$q->id}}/favorite" id="favorite-question-{{$q->id}}" method="post" style="display:none">
                                    @csrf
                                </form>
                            @endif

                        </div>

                        <div class="media-body">
                            {{-- to show the text in html design --}}
                            {!! $q->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Asked {{ $q->created_date }}
                                </span>
                                <div class="media mt-2">
                                    <a href="{{$q->user->url}}" class="pr-2">
                                        <img src="{{$q->user->avatar}}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$q->user->url}}">
                                            {{$q->user->name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers.index')
    @include('answers.create')
</div>
@endsection
