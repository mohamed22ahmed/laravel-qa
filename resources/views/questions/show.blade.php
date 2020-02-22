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
                            <a class="vote-up" title="This question is useful">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question (click again to undo)" class="favorite mt-2">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorite-count">123</span>
                            </a>
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
