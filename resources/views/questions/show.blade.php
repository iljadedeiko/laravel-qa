@extends('layouts.app')

@section('content')
<div class="container answers-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            @if (!empty($question->category->category_name))
                                <h3 class="mr-3 text-primary font-weight-bold">{{ $question->category->category_name }}</h3>
                            @endif
                            <h1 class="col-9 question-title">{{ $question->title }}</h1>
                            <div class="{{ empty($question->category->category_name) ? 'col-3 back-home' : '' }}">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">{{ __('Back to all questions') }}</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">

                            @cannot ('vote-own-question', $question)
                                <a title="{{ __('Mark this question as useful') }}"
                                    class="vote-up {{ $auth::guest() ? 'off' : '' }}
                                    {{ ($question->user->id == $auth::id()) ? 'off' : '' }}"
                                    onclick="event.preventDefault(); document.getElementById( 'vote-up-question-{{ $question->id }}').submit();">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>

                                <form method="POST" class="vote-up-question" action="/questions/{{ $question->id }}/vote-question" id="vote-up-question-{{ $question->id }}">
                                    @csrf
                                    <input type="hidden" name="vote_question" value="1">
                                </form>

                                <span class="votes-count">{{ $question->votes_count }}</span>

                                <a title="{{ __('Mark this question as not useful') }}"
                                    class="vote-down {{ $auth::guest() ? 'off' : '' }}
                                    {{ ($question->user->id == $auth::id()) ? 'off' : '' }}"
                                    onclick="event.preventDefault(); document.getElementById( 'vote-down-question-{{ $question->id }}').submit();">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>

                                <form method="POST" class="vote-down-question" action="/questions/{{ $question->id }}/vote-question" id="vote-down-question-{{ $question->id }}">
                                    @csrf
                                    <input type="hidden" name="vote_question" value="-1">
                                </form>
                            @else
                                <a title="{{ __('You can not vote for your own question') }}" class="off cursor-not-allowed">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>

                                <span class="votes-count">{{ $question->votes_count }}</span>

                                <a title="{{ __('You can not vote for your own question') }}" class="off cursor-not-allowed">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                            @endcannot

                            <a title="{{ __('Click to mark as favorite question') }}"
                               class="favorite mt-3 {{ $auth::guest() ? 'off' : ($question->favorite_question ? 'favorited' : '') }}"
                               onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorite-count">{{ $question->favorites_count }}</span>
                            </a>

                            <form method="POST" class="favorite-question" action="/questions/{{ $question->id }}/favorites" id="favorite-question-{{ $question->id }}">
                                @csrf
                                @if ($question->favorite_question)
                                    @method ('DELETE')
                                @endif
                            </form>
                        </div>

                        <div class="media-body">
                            <div class="question-text pr-5 mb-3">{!! $question->body_html !!}</div>
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
        'answersCount' => $question->answers_count,
        'auth' => $auth,
    ])

    @include ('answers.create')
</div>

@endsection
