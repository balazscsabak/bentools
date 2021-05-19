<x-app-layout>

    <div class="message-page pb-5">
        <div class="container">

            <div class="d-flex justify-content-md-center">
                <div class="col-7">
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

                    <div class="message">

                        <h1>
                            Üzenet küldése
                        </h1>

                        <div class="icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <p>
                            Küldjön üzenetet az alábbi formon keresztül és mi felvesszük Önnel a kapcsolatot!
                        </p>

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
            </div>

        
        </div>
    </div>


</x-app-layout>
