$(() => {

    var messages = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#hiddenAjaxUrl').val(),
        createdRow: function( row, data, dataIndex ) {
            if(data.unread) {
                $(row).addClass('unread');
            } 
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email'},
            {data: 'firm_name', name: 'firm_name'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

    var posts = $('.yajra-datatable-posts').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#hiddenAjaxUrl').val(),
        createdRow: function( row, data, dataIndex ) {
            console.log('hi')
            if(data.unread) {
                $(row).addClass('unread');
            } 
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'full_name'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

})