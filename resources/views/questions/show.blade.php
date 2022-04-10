@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            @if (!empty($question->category->category_name))
                                <h3 class="mr-3 text-primary font-weight-bold">{{ $question->category->category_name }}</h3>
                            @endif
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">{{ __('Back to all questions') }}</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">

                        <div class="d-flex flex-column vote-controls">
                            <a title="{{ __('This question is useful') }}" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1234</span>
                            <a title="{{ __('This question is not useful') }}" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="{{ __('Click to mark as favourite question') }}"
                               class="favourite mt-3 {{ $auth::guest() ? 'off' : ($question->favourite_question ? 'favourited' : '') }}"
                               onclick="event.preventDefault(); document.getElementById('favourite-question-{{ $question->id }}').submit();">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favourite-count">{{ $question->favourites_count }}</span>
                            </a>
                            <form method="POST" class="favourite-question" action="/questions/{{ $question->id }}/favourites" id="favourite-question-{{ $question->id }}">
                                @csrf
                                @if ($question->favourite_question)
                                    @method ('DELETE')
                                @endif
                            </form>
                        </div>

                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <div class="text-muted">{{ __('Asked') }} {{ $question->created_at->format("M d,Y") }} {{ __('at') }} {{ $question->created_at->format("H:i") }}</div>
                                <div class="media mt-1">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        <img src="{{ $question->user->avatar }}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include ('answers.index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count
    ])

    @include ('answers.create')
</div>

@endsection
