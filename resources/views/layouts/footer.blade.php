<footer class="text-center text-lg-start bg-light text-muted">
    <hr>
    <section class="panel-footer">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <a class="text-muted text-decoration-none" href="{{ route('login') }}">
                            <i class="fas fa-circle-question me-3"></i>
                            {{ __('AskDeveloper') }}
                        </a>
                    </h6>
                    <p>This web application is developed to bring together software developers with different skills and
                        any kind of experience.</p>
                    <b>Never Code Alone !</b>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <p>Popular categories</p>
                    </h6>
                    <p>Python</p>
                    <p>PHP</p>
                    <p>Javascript</p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <p class="text-uppercase">
                        <a href="{{ route('leaderboard.index') }}" class="text-reset">Leaderboard</a>
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <p>Contact Us</p>
                    </h6>
                    <p><i class="fas fa-home me-3"></i>Vilnius, Lithuania</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 370 234 567 88</p>
                    <p><i class="fas fa-print me-3"></i> + 370 234 567 89</p>
                </div>
            </div>
        </div>
    </section>
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="#">{{ __('AskDeveloper') }}</a>
    </div>
</footer>
