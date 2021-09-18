<x-admin-layout>
    <input type="hidden" id="hiddenAjaxUrl" value="{{ $hiddenAjaxUrl }}">

    <div class="mt-4">
        <a href="/admin/messages" class="btn btn-warning btn-sm">Összes</a>
        <a href="/admin/messages?filter=read" class="btn btn-warning btn-sm">Olvasott</a>
        <a href="/admin/messages?filter=unread" class="btn btn-warning btn-sm">Olvasatlan</a>
    </div>
    <div class="container mt-3 mb-5">
        <h2 class="mb-4">Üzenetek</h2>
        <table class="table table-responsive table-hover yajra-datatable">
            <thead >
                <tr class="table-dark">
                    <th>No.</th>
                    <th>Név</th>
                    <th>Email</th>
                    <th>Cégnév</th>
                    <th>Telefonszám</th>
                    <th>Létrejött</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</x-admin-layout>