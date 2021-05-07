<div class="post-wrapper col-3">
    <a class="post" href="{{ route('post', $post->slug) }}">
        <div class="post__content" style="background-image: linear-gradient(#ffffff03, #363636bd), url('/storage/{{ $post->image->path }}')">
            <div class="img-bg" >
                <div class="title"><h3>{{ $post->title }}</h3></div>
                <div class="read-more">Tovább <i class="fas fa-angle-double-right"></i></div>    
            </div>
        </div>
    </a>
</div>