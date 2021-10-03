<x-app-layout>

    <div class="post-page mb-5">
        <div class="container">
            
            <div class="justify-content-md-center row">
                <div class="col-12 col-lg-10">

                <h1 class="mb-3">
                    Hírek
                </h1>

                <div class="row gx-4 gy-5">
                    @foreach ($posts as $post)
                        <div class="post-wrapper col-12 col-md-4 col-lg-4">
                            <a class="post" href="{{ route('post', $post->slug) }}">
                                <div class="post__content lazy" 
                                    {{-- data-bg-multi="linear-gradient(#ffffff03, #363636bd), url('/storage/{{ $post->image->path }}')"> --}}
                                    style="background: linear-gradient(#ffffff03, #363636bd), url('/storage/{{ $post->image->path }}')">
                                    <div class="img-bg" >
                                        <div class="title"><h3>{{ $post->title }}</h3></div>
                                        <div class="read-more">Tovább <i class="fas fa-angle-double-right"></i></div>    
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
