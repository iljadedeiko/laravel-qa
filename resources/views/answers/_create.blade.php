<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>{{ __('Your Answer') }}</h3>
                </div>
                <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7">
                            {{ old('body') }}</textarea>
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