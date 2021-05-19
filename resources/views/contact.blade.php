<x-app-layout>

    <div class="contact-page">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-9">

                    <div class="contact">
                        <h1 class="contact__h1">
                            Kapcsolat
                        </h1>

                        <div class="contact__icon ">
                            <i class="fas fa-address-card"></i>
                        </div>

                        <p class="contact__p">
                            {{ $message }}
                        </p>

                        <div class="info">

                            <div class="phone">
                                <div class="text">
                                    Telefonszám
                                </div>
                                <div class="icon my-1">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="value">
                                    {{ $phone }}
                                </div>
                            </div>

                            <div class="email">
                                <div class="text">
                                    Email
                                </div>
                                <div class="icon my-1">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div class="value">
                                    {{ $email }}
                                </div>
                            </div>

                            <div class="address">
                                <div class="text">
                                    Cím
                                </div>
                                <div class="icon my-1">
                                    <i class="fas fa-map-marker"></i>
                                </div>
                                <div class="value">
                                    {{ $address }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="mt-5" style="background-color: #efefef;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2664.526212053665!2d19.810911315647683!3d48.100083979220464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47406d344e53bdd7%3A0xd658cf8186c4bb73!2zU2FsZ8OzdGFyasOhbiwgRGFtamFuaWNoIErDoW5vcyDDunQgNDgsIDMxMDA!5e0!3m2!1shu!2shu!4v1620391665203!5m2!1shu!2shu" width="100%" height="450" style="border:0;" allowfullscreen="0" loading="lazy"></iframe>
        </div>
    </div>

</x-app-layout>
