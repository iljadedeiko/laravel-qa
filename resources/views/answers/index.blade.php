<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . ' ' . __('answer(-s)')}}</h2>
                </div>
                <hr>
                @include ('layouts.messages')

                @foreach ($answers as $answer)
                    <div class="media">

                        <div class="d-flex flex-column vote-controls">
                            <a title="{{ __('This answer is useful') }}" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1234</span>
                            <a title="{{ __('This answer is not useful') }}" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            @can ('mark-answer', $answer)
                                <a title="{{ __('Mark this answer as best answer') }}"
                                    class="mt-3 {{ $answer->status }}"
                                    onclick="event.preventDefault(); document.getElementById('mark-answer-{{ $answer->id }}').submit();">
                                    <i class="fa fa-plus fa-2x"></i>
                                </a>
                                <form method="POST" class="mark-answer" action="{{ route('answers.mark', $answer->id) }}" id="mark-answer-{{ $answer->id }}">
                                    @csrf
                                </form>
                            @else
                                @if ($answer->best_answer)
                                    <a title="{{ __('The question author marked this answer as best answer') }}" class="mt-3 {{ $answer->status }}">
                                       <i class="fa fa-plus fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>

                        <div class="media-body">
                            <div class="mb-4">
                                <div class="text-muted">{{ __('Answered') }} {{ $answer->created_at->format("M d,Y") }}
                                    {{ __('at') }} {{ $question->created_at->format("H:i") }}</div>
                                <div class="media mt-1">
                                    <a href="{{ $answer->user->url }}" class="pr-2">
                                        <img src="{{ $answer->user->avatar }}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update-answer', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>
                                        @endcan

                                        @can('delete-answer', $answer)
                                            <form method="POST" class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                                                @method('DELETE')
                                                @csrf

                                                <button type="submit" class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
