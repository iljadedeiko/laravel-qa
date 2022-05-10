@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error_message">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
