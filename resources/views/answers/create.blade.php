<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('Your Answer') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        @include ('answers.textEditor')

                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
