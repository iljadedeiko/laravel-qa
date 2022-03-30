@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
