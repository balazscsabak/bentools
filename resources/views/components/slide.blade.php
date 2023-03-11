<div class="swiper-slide hero-slide">
    <div class="bg-blur lazy hero-bg" 
        data-bg-multi="linear-gradient(rgb(33 29 29 / 41%), rgb(11 12 12 / 38%)),  url('/storage/{{ $slide->imageData->path }}')"
    ></div>
    <div class="swiper-content">
        <a class="text-decoration-none" href="{{ $slide->link_href }}">
            <h1 class="fs-4 ">{{ $slide->title }}</h1>
            <p>{{ $slide->content }}</p>
        </a>
    </div>
</div>