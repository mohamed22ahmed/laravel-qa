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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
