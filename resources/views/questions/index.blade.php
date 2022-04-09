@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2 class="mr-auto">{{ __('All Questions') }}</h2>
                            <div class="dropdown pr-4">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle px-4" data-toggle="dropdown">
                                    {{ __('Category') }}
                                </button>
                                <div class="dropdown-menu categories">
                                    @foreach ($categories as $category)
                                        <a class="dropdown-item" href="#">{{ $category->category_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="ask-question">
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">{{ __('Ask Question') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.messages')

                        @foreach($questions as $question)
                            <div class="media">
                                <div class="d-flex flex-column counters">
                                    <div class="vote">
                                        <strong>{{ $question->votes }}</strong> {{ $str::plural('vote', $question->votes) }}
                                    </div>
                                    <div class="status {{ $question->status }}">
                                        <strong>{{ $question->answers_count }}</strong> {{ $str::plural('answer', $question->answers_count) }}
                                    </div>
                                    <div class="view">
                                        {{ $question->views . " " . $str::plural('view', $question->views) }}
                                    </div>
                                </div>

                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                        <div class="ml-auto">
                                            @can('update-question', $question)
                                                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>
                                            @endcan

                                            @can('delete-question', $question)
                                                <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>

                                    <p class="lead">
                                        {{ __('Asked By') }}
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        <small class="text-muted">{{ $question->created_date }}</small>
                                    </p>
                                    {{ $str::limit($question->body, 250) }}
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <div class="pagination justify-content-center">
                            {{ $questions->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
