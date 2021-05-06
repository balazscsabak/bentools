<div class="swiper-slide hero-slide">
    <div class="bg-blur" style="background-image: linear-gradient(
        rgb(33 29 29 / 41%),
        rgb(11 12 12 / 38%)
      ),  url('/storage/{{ $slide->imageData->path }}')"></div>
    <div class="swiper-content">
        <h1>{{ $slide->title }}</h1>
        <p>{{ $slide->content }}</p>
        <a class="btn btn-lg btn-primary" href="{{ $slide->link_href }}">{{ $slide->link_text }}</a>
    </div>
</div>