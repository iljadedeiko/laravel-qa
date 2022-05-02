@extends('layouts.app')

@section('content')
    <div class="container questions-block">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <img class="ml-1" src="{{ asset('images/favorites-30.svg') }}" alt="{{ __('Favorites questions icon') }}">
                            <h2 class="mr-auto my-favorites">
                                {{ __('My Favorites Questions') }}
                            </h2>
                            {{--                            <div class="dropdown pr-4">--}}
                            {{--                                <select class="form-control categories" name="categories" id="categories">--}}
                            {{--                                    <option selected>{{ __('All questions') }}</option>--}}
                            {{--                                    @foreach ($categories as $category)--}}
                            {{--                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            <categories :categories="{{$categories}}"></categories>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.messages')

                        @if (count($userFavQuestions) < 1)
                            <div class="alert alert-primary mx-5 my-5 text-center" role="alert">{{ __("No question has yet been added to favourites. You can add them here by pressing the relevant button on the question page !") }}</div>
                        @endif

                        @foreach($userFavQuestions as $favQuestion)
                            <div class="media favorite-media-block">
                                <a title="{{ __('Remove this question from favorites') }}"
                                   class="remove-favorite {{ $favQuestion->favorite_question ? 'favorited' : '' }}"
                                   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $favQuestion->id }}').submit();">
                                    <img class="remove-favorite-visible" src="{{ asset('images/delete-button-black-30.svg') }}" alt="Remove from favorites button">
                                    <img class="remove-favorite-hidden" src="{{ asset('images/delete-button-white-30.svg') }}" alt="Remove from favorites button">
                                </a>

                                <form method="POST" class="favorite-question" action="/questions/{{ $favQuestion->id }}/favorites" id="favorite-question-{{ $favQuestion->id }}">
                                    @csrf
                                    @if ($favQuestion->favorite_question)
                                        @method ('DELETE')
                                    @endif
                                </form>

                                <div class="d-flex flex-column counters">
                                    <div class="vote">
                                        <strong>{{ $favQuestion->votes_count }}</strong> {{ $str::plural('vote', $favQuestion->votes_count) }}
                                    </div>
                                    <div class="status {{ $favQuestion->status }}">
                                        <strong>{{ $favQuestion->answers_count }}</strong> {{ $str::plural('answer', $favQuestion->answers_count) }}
                                    </div>
                                    <div class="view">
                                        {{ $favQuestion->views . " " . $str::plural('view', $favQuestion->views) }}
                                    </div>
                                </div>

                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0
                                            {{ (!empty($favQuestion->category->category_name) || Auth::id() == $favQuestion->user_id) ? 'col-10' : 'col-12 pr-5' }}">
                                            <a href="{{ $favQuestion->url }}">{{ $favQuestion->title }}</a>
                                        </h3>
                                        <div class="ml-auto col-2">
                                            @if (!empty($favQuestion->category->category_name))
                                                <h4 class="text-primary font-weight-bold">{{ $favQuestion->category->category_name }}</h4>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="lead col-10">
                                        {{ __('Asked By') }}
                                        <a href="{{ $favQuestion->user->url }}">{{ $favQuestion->user->name }}</a>
                                        <small class="text-muted">{{ $favQuestion->created_date }}</small>
                                    </p>
                                    <div class="{{ (!empty($favQuestion->category->category_name) || Auth::id() == $favQuestion->user_id) ? 'col-10' : 'col-12 pr-5' }}">
                                        {!! $str::limit($favQuestion->body_html, 300) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <div class="pagination justify-content-center">
                            {{ $userFavQuestions->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

