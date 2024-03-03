<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg" style="height: auto;">
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
            <div class="lc-block">{{ $slot }}</div>
        </div>
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <div class="lc-block mb-3">
                <div editable="rich">
                    <h2 class="fw-bold display-4">{{ $title }}<p></p>
                        <p></p>
                    </h2>
                </div>
            </div>

            <div class="lc-block mb-3">
                <div editable="rich">
                    <p class="lead">{{ $synopsis }}</p>
                    <footer class="blockquote-footer mt-2">Release date {{ $releaseDate->format('Y') }}</footer>
                </div>
            </div>

            <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start"><a class="btn btn-danger px-4 me-md-2"
                    href="{{ route('content.show', ['id' => $id]) }}" role="button">Go to movie</a>
            </div>
        </div>

    </div>
</div>
