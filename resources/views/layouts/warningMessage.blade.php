@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_message">
        <strong>{{ session('warning') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
