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
                            <a title="{{ __('This question is useful') }}"
                                class="vote-up {{ \Illuminate\Support\Facades\Auth::guest() ? 'off' : '' }}
                                {{ ($question->user->id == \Illuminate\Support\Facades\Auth::id()) ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById( 'up-vote-question-{{ $question->id }}').submit();">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>

                            <form method="POST" class="up-vote-question" action="/questions/{{ $question->id }}/vote-question" id="up-vote-question-{{ $question->id }}">
                                @csrf
                                <input type="hidden" name="vote_question" value="1">
                            </form>

                            <span class="votes-count">{{ $question->votes }}</span>
                            <a title="{{ __('This question is not useful') }}"
                                class="vote-down {{ \Illuminate\Support\Facades\Auth::guest() ? 'off' : '' }}
                                {{ ($question->user->id == \Illuminate\Support\Facades\Auth::id()) ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById( 'down-vote-question-{{ $question->id }}').submit();">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            <form method="POST" class="down-vote-question" action="/questions/{{ $question->id }}/vote-question" id="down-vote-question-{{ $question->id }}">
                                @csrf
                                <input type="hidden" name="vote_question" value="-1">
                            </form>

                            <a title="{{ __('Click to mark as favorite question') }}"
                               class="favorite mt-3 {{ $auth::guest() ? 'off' : ($question->favorite_question ? 'favorited' : '') }}
                               {{ ($question->user->id == \Illuminate\Support\Facades\Auth::id()) ? 'off' : '' }}"
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
