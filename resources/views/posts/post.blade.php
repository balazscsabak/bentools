<x-app-layout>

    <div class="post-page mb-5">
        <div class="container">

            <div class="d-flex justify-content-md-center">
                <div class="col-12 col-md-7">
                    <div class="post">

                        <div class="title">
                            <h1>
                                {{ $post->title }}
                            </h1>
                        </div>

                        @isset($post->excerpt)
                            <div class="excerpt">
                                <p>
                                    {{ $post->excerpt }}
                                </p>
                            </div>
                        @endisset

                        <div class="featured-image">
                            <img src="/storage/{{ $post->image->path }}" alt="{{ $post->image->name }}">
                        </div>

                        <div class="content">
                            {!! $post->content !!}
                        </div>

                    </div>
                </div>
            </div>

        
        </div>
    </div>


</x-app-layout>
