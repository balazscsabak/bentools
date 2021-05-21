<x-admin-layout>
    <div class="container mt-3 mb-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                {{ $message }}
            </div>
        @endif

        <h2>Slideshow</h2>

        <div class="my-3">
            <button class="btn btn-primary btn-sm" id="add-new-slide">Új elem</button>
        </div>

        <form action="{{ route('settings.slideshow.save') }}" method="POST">
            @csrf

            <div id="slideshow-wrapper" class="row gy-3">

                @foreach ($slideshow as $slide)

                    <div class="slide col-6 rounded">

                        <div class="with-shadow p-3">

                            <div class="mb-3">
                                <label class="form-label">Cím</label>
                                <input type="text" class="form-control" name="slide[{{ $loop->index }}][title]" value="{{ $slide->title }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Szöveg</label>
                                <input type="text" class="form-control" name="slide[{{ $loop->index }}][content]" value="{{ $slide->content }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gomb szöveg</label>
                                <input type="text" class="form-control" name="slide[{{ $loop->index }}][link_text]" value="{{ $slide->link_text }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gomb link</label>
                                <input type="text" class="form-control" name="slide[{{ $loop->index }}][link_href]" value="{{ $slide->link_href }}">
                            </div>

                            <div class="mb-3 slide-img">
                                <label class="form-label">Háttérkép</label>
                                <button data-img-id={{ $slide->image}} class="btn btn-primary btn-sm open-slide-img-modal-btn" data-bs-toggle="modal" data-bs-target="#slide-image-picker-modal">Új kép</button>
                                <input class="hidden-img-id" type="hidden" name="slide[{{ $loop->index }}][image]" value={{ $slide->image }}>
                                <img src="/storage/{{ $slide->imageData->path }}" alt="">
                            </div>

                        </div>
                    </div>
                
                @endforeach

            </div>
            
            <input class="btn btn-primary" type="submit" value="Mentés">
        </form>
    </div>

    <div class="modal fade" id="slide-image-picker-modal" tabindex="-1" aria-labelledby="product-main-image-picker" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Válassz képet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    loading ..
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="set-slide-img-btn">Mentés</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>