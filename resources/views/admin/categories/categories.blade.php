<x-admin-layout>

    <div class="container mt-3">
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

        <h2 class="mb-3">Kategóriák</h2>

        <div>
            <a class="btn btn-primary btn-sm mb-3" href="{{ route('categories.create') }}">Új Kategória</a>
        </div>

        <div class="admin-categories">
            <div class="row gy-5 gx-5">

                @foreach ($categories as $id => $cat)
            
                    @if ($id > 1)

                        <div class="main col-3">
                        
                            <a href="{{ route('categories.show', $id) }}">{{ $cat['name'] }}</a>

                            @isset($cat['sub'])

                                <div>
                            
                                    @foreach ($cat['sub'] as $subcat)
                                    
                                        <div class="child ms-1">
                                            <a href="{{ route('categories.show', $subcat['id']) }}"><span>-</span> {{ $subcat['name'] }} </a>
                                        </div>

                                    @endforeach
                                
                                </div>

                            @endisset
                        
                        </div>

                    @endif
                
                @endforeach
                
            </div>
        </div>

    </div>

</x-admin-layout>