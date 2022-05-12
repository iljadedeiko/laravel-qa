<div>
    <div class="container">
        <div class="col-3 dropdown pl-0 mb-3">
            <select wire:model="selectedLanguage" class="form-control" id="exampleSelect">
                <option value="" selected>{{ __("Programming language") }}</option>
                @foreach ($progLanguages as $language)
                    <option value="{{ strtolower($language->prog_language) }}">{{ $language->prog_language }}</option>
                @endforeach
            </select>
        </div>

        <textarea wire:model="script" name="test-code-block" id="test_code_block" rows="10" class="form-control" placeholder="{{ __('Write your code here...') }}"></textarea>

        <div class="row">
            <button @if ($script == '') disabled @endif wire:click="button" type="button" class="btn btn-md btn-primary ml-3 mt-2">{{ __('Test code') }}</button>
        </div>

        <textarea readonly rows="4" class="form-control mt-4 code-output" placeholder="{{ __('Output') }}">@if (isset($compilerResponse["output"])) {{ $compilerResponse["output"] }} @endif</textarea>
    </div>
</div>
