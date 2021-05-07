<x-app-layout>

    <div class="offer-page mb-4">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-7">

                    <div class="offer">
                        
                        <h1 class="offer__h1">
                            Ajánlatkérés
                        </h1>

                        <div class="offer__icon ">
                            <i class="fas fa-dolly"></i>
                        </div>

                        <p class="offer__p">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptates eius atque laudantium nulla praesentium, numquam veniam. Quo, nobis molestiae?
                        </p>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <div class="data">
                        <form action="{{ route('message.store') }}" method="post">
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
                <div class="col-6">
                    <div id="cart">
                        <div class="title">
                            Termékek
                        </div>
                        <div class="items ps-3 pt-2">
                            <p>Kérjük adjon hozzá terméket a listához!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <div class="col-7">

                    <div class="offer">
                        <div class="products">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Termék név</th>
                                        <th scope="col" >Mennyiség</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($products)
                                    @foreach ($products as $product)
                                    <tr>
                                        <td class="py-2">{{ $product->name }}</td>
                                        <td class="py-2">
                                            <div class="cart-action-add">
                                                <input type="number" min="1" max="200" value="1" >
                                                
                                                <div class="btn btn-primary btn-sm add-to-cart-btn ms-2" data-name="{{ $product->name }}">
                                                    Hozzáad
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                        
                </div>

            </div>
            
        </div>
    </div>

</x-app-layout>
