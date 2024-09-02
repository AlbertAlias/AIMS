$(document).ready(function() {
    $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "controller/manage-user/retrieve-users.php",
            "type": "POST",
            "dataSrc": function (json) {
                console.log(json); // Debugging line to check the response
                return json.aaData;
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