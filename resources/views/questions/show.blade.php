@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{$q->title}}</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
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
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="float-right">
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
                        </div><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
