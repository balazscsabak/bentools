<x-app-layout>

    <div class="offer-page mb-4">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

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

            <div id="shopping-cart-offer">
                <div class="d-flex justify-content-center">
                    <div class="col-12 col-md-7">

                        <div class="offer">
                            
                            <h1 class="offer__h1">
                                Ajánlatkérés
                            </h1>

                            <div class="offer__icon ">
                                <i class="fas fa-dolly"></i>
                            </div>

                            <p class="offer__p">
                                {{ $content }}    
                            </p>

                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-4 mb-md-4">
                        <div class="data">
                            <form action="{{ route('offer.store') }}" method="post" id="offer-form">
                                @csrf

                                <div class="col-12 mb-2">
                                    <label for="full_name" class="form-label">Teljes név</label>
                                    <input name="full_name" type="text" class="form-control" id="full_name">
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="firm_name" class="form-label">Cég név</label>
                                    <input name="firm_name" type="text" class="form-control" id="firm_name">
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="email">
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="phone_number" class="form-label">Telefonszám</label>
                                    <input name="phone_number" type="text" class="form-control" id="phone_number">
                                </div>

                                <div class="col-12 mb-4">
                                    <label for="message" class="form-label">Üzenet</label>
                                    <textarea name="message" class="form-control" id="message"></textarea>
                                </div>

                                <div class="submit">
                                    <input type="submit" value="Küldés" class="btn btn-primary btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div id="cart">
                            <div class="title">
                                Termékek
                            </div>
                            <div class="items ps-3 pt-2">
                                <div class="cart-items">
                            
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th class="text-end pe-3" scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

</x-app-layout>
