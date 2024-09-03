$(document).ready(function() {
    $('#dataTable').DataTable({
        "scrollX": true,
        "stateSave": true,
        "search": {
            return: true
        },
        "lengthMenu": [
            [5, 10, 20, 50, -1],
            [5, 10, 20, 50, 'All']
        ],
        "layout": {
            topEnd: {
                search: {
                    placeholder: 'Find it here'
                }
            },
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "controller/manage-users/retrieve-users.php",
            "type": "POST",
            "dataSrc": function (json) {
                console.log(json);
                return json.data;
            }
        },
        "columns": [
            { "data": "firstname" },
            { "data": "lastname" },
            { "data": "department" },
            { "data": "studentID" },
            { "data": "company" },
            { "data": "email" },
            { "data": "password" },
            { "data": "user_type" },
            { "data": "action", "orderable": false, "searchable": false }
        ]
    });
});