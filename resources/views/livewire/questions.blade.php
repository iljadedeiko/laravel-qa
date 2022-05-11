<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-content-end">
                <h2 class="col-7 questions-header">{{ __('Questions') }}</h2>
                <div class="col-3 dropdown pr-4 float-right">
                    <select wire:model="selectedCategory" class="form-control categories" name="categories"
                            id="categories">
                        <option value="" selected>{{ __('All questions') }}</option>
                        @if (Auth::check())
                            <option value="my_questions" selected>{{ __('My questions') }}</option>
                        @endif
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 ask-question">
                    <a href="{{ route('questions.create') }}"
                       class="btn btn-outline-secondary float-right">{{ __('Ask Question') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.successMessage')
            @include('layouts.warningMessage')

            @if (count($questions) < 1)
                <div class="alert alert-warning">
                    <strong>{{ __('No questions were found.') }}</strong> {{ __('Create a new question and it will appear here !') }}
                </div>
            @else
                @foreach ($questions as $question)

                    @include('questions.deleteModal')

                    <div class="media questions">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $question->votes_count }}</strong> {{ $str::plural('vote', $question->votes_count) }}
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
                                <h3 class="mt-0 {{ (!empty($question->category->category_name) || Auth::id() == $question->user_id) ? 'col-10' : 'col-12 pr-5' }}">
                                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                                </h3>
                                <div class="ml-auto col-2">
                                    @if (!empty($question->category->category_name))
                                        <h4 class="text-primary font-weight-bold">{{ $question->category->category_name }}</h4>
                                    @endif

                                    @can('update-question', $question)
                                        <a href="{{ route('questions.edit', $question->id) }}"
                                           class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>
                                    @endcan

                                    @can('delete-question', $question)
                                        <a href="#deleteModal" data-toggle="modal">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                {{ __('Delete') }}
                                            </button>
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <p class="lead col-10">
                                {{ __('Asked By') }}
                                <a href="{{ route('user.profile.show', $question->user->id) }}">{{ $question->user->name }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            <div
                                class="{{ (!empty($question->category->category_name) || Auth::id() == $question->user_id) ? 'col-10' : 'col-12 pr-5' }}">
                                {!! $str::limit($question->body_html, 300) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{ $questions->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
