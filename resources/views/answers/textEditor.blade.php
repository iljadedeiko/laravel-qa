<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#write-tab">{{ __('Answer editor') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#preview-tab">{{ __('Test your code') }}</a>
            </li>
        </ul>
    </div>
    <div class="card-body tab-content">
        @if (isset($answer))
            <div class="tab-pane active" id="write-tab">
                <textarea name="body" id="answer_textarea" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7">{{ old('body', $answer->body) }}</textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('body') }}</strong>
                    </div>
                @endif
            </div>
        @else
            <div class="tab-pane active" id="write-tab">
                <textarea name="body" id="answer_edit_textarea" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7">{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('body') }}</strong>
                    </div>
                @endif
            </div>
        @endif
        <div class="tab-pane" id="preview-tab">
            <textarea name="test-code-block" id="test_code_block" rows="10" class="form-control"></textarea>
        </div>
    </div>
</div>
