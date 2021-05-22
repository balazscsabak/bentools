<x-admin-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                Név
            </div>
            <div class="col-9">
                {{ $message->full_name ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Cégnév
            </div>
            <div class="col-9">
                {{ $message->firm_name ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Email
            </div>
            <div class="col-9">
                {{ $message->email ?? '' }}
            </div>
            
            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Telefonszám
            </div>
            <div class="col-9">
                {{ $message->phone_number ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Dátum
            </div>
            <div class="col-9">
                {{ $message->created_at ?? '' }}
            </div>

            <div class="offer-data-divider w-100"></div>

            <div class="col-3">
                Üzenet
            </div>
            <div class="col-9">
                {!! nl2br($message->message) ?? '' !!}
            </div>
            
        </div>

        <div class="my-5">
            <a class="btn btn-secondary me-2 btn-sm" href="{{ route('messages') }}">Vissza</a>
            <a class="btn btn-secondary me-2 btn-sm" href="{{ route('messages.setreaded', $id) }}" >Megjelölés olvasottként</a>
            <a class="btn btn-secondary me-2 btn-sm" href="{{ route('messages.setarchive', $id) }}" >Archiválás</a>
        </div>
    </div>

</x-admin-layout>