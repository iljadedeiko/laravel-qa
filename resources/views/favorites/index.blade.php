@extends('layouts.app')

@section('content')
    <div class="container questions-block">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <img class="ml-1" src="{{ asset('images/favorites-30.svg') }}" alt="Favorites questions icon">
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

                        @foreach($userFavQuestions as $favQuestion)
                            <div class="media">
                                <div class="d-flex flex-column counters">
                                    <div class="vote">
                                        <strong>{{ $favQuestion->votes_count }}</strong> {{ $str::plural('vote', $favQuestion->votes_count) }}
                                    </div>
{{--                                    <div class="status {{ $statusAttribute->status }}">--}}
                                        <strong>{{ $favQuestion->answers_count }}</strong> {{ $str::plural('answer', $favQuestion->answers_count) }}
{{--                                    </div>--}}
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

                                            @can('update-question', $favQuestion)
                                                <a href="{{ route('questions.edit', $favQuestion->id) }}" class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>
                                            @endcan

                                            @can('delete-question', $favQuestion)
                                                <form class="form-delete" action="{{ route('questions.destroy', $favQuestion->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>

                                    <p class="lead col-10">
                                        {{ __('Asked By') }}
                                        <a href="{{ $favQuestion->user->url }}">{{ $favQuestion->user->name }}</a>
                                        <small class="text-muted">{{ $favQuestion->created_date }}</small>
                                    </p>
                                    <p class="{{ (!empty($favQuestion->category->category_name) || Auth::id() == $favQuestion->user_id) ? 'col-10' : 'col-12 pr-5' }}">
                                        {{ $str::limit($favQuestion->body, 250) }}
                                    </p>
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

