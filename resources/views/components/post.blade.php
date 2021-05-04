<div class="post-wrapper col-3">
    <a class="post" href="#">
        <div class="post__content" style="background-image: linear-gradient(#00000026, #000000e8), url('/storage/{{ $post->image->path }}')">
            <div class="img-bg" >
                <div class="title"><h3>{{ $post->title }}</h3></div>
                <div class="read-more">Tovább <i class="fas fa-angle-double-right"></i></div>    
            </div>
        </div>
    </a>
</div>