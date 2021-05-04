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

        <div>
            <a href="{{ route('categories.create') }}">Új Kategória</a>
        </div>

        <ul>

            @foreach ($categories as $id => $cat)
        
                <li>
                   
                    <a href="{{ route('categories.show', $id) }}">{{ $cat['name'] }}</a>

                    @isset($cat['sub'])

                        <ul>
                       
                            @foreach ($cat['sub'] as $subcat)
                            
                                <li>
                                    <a href="{{ route('categories.show', $subcat['id']) }}">{{ $subcat['name'] }}</a>
                                </li>

                            @endforeach
                        
                        </ul>

                    @endisset
                
                </li>
            
            @endforeach
            
        </ul>
    </div>

</x-admin-layout>