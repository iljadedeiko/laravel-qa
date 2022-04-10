<template>
    <div class="media">
        <div class="d-flex flex-column counters">
            <div class="vote">
    <!--            <strong>{{ $question->votes }}</strong> {{ $str::plural('vote', $question->votes) }}-->
                <strong> 123 </strong>
            </div>
    <!--        <div class="status {{ $question->status }}">-->
            <div class="status">
    <!--            <strong>{{ $question->answers_count }}</strong> {{ $str::plural('answer', $question->answers_count) }}-->
                <strong> 123 </strong>
            </div>
            <div class="view">
    <!--            {{ $question->views . " " . $str::plural('view', $question->views) }}-->
                123
            </div>
        </div>

        <div class="media-body">
            <div class="d-flex align-items-center">
    <!--            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>-->
                <h3 class="mt-0"><a href="#">question title</a></h3>
                <div class="ml-auto">
    <!--                @can('update-question', $question)-->
    <!--                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>-->
    <!--                <a href="#" class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>-->
                    <a href="#" class="btn btn-sm btn-outline-info">Edit</a>
    <!--                @endcan-->

    <!--                @can('delete-question', $question)-->
    <!--                <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">-->
                    <form class="form-delete" action="#" method="post">
    <!--                    @csrf-->
    <!--                    @method('DELETE')-->

    <!--                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>-->
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure')">Delete</button>
                    </form>
    <!--                @endcan-->
                </div>
            </div>

            <p class="lead">
    <!--            {{ __('Asked By') }}-->
                Asked by
    <!--            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>-->
                <a href="#">username</a>
    <!--            <small class="text-muted">{{ $question->created_date }}</small>-->
                <small class="text-muted">created date</small>
            </p>
    <!--        {{ $str::limit($question->body, 250) }}-->
        </div>
    </div>
</template>

<script>
    export default {
        props: ['questions'],
        data: function() {
            return {

            }
        },
    }
</script>
