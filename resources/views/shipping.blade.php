<x-app-layout>

    <div class="shipping-page pb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-7">

                    <div class="shipping">
                        
                        <h1 class="shipping__h1">
                            Szállítási információk
                        </h1>

                        <div class="shipping__icon ">
                            <i class="fas fa-dolly"></i>
                        </div>

                        <div class="shipping__content">
                            {!! $content !!}
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
