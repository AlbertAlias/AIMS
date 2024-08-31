<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.2rem; /* Adjust spacing between buttons */
        }

        /* Reduce the size of pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-size: 0.875rem; /* Adjust font size */
        }

        /* Style the active button */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff; /* Adjust background color */
            color: #fff; /* Adjust text color */
            border-radius: 0.25rem; /* Adjust border radius */
        }

        /* Style the disabled buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #6c757d; /* Adjust color */
            cursor: not-allowed;
        }

        /* Adjust spacing around the pagination container */
        .dataTables_wrapper .dataTables_paginate {
            margin: 1rem 0; /* Adjust margins */
        }
    </style>
</head>
<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bold text-primary mb-0">Manage Users</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- <table class="table table-bordered" id="users-acc_dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Student ID</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Student ID</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody id="tdata"></tbody>
                    </table> -->
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Student ID</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tdata">
                            <!-- Data goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="mb-3" id="departmentField">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" id="department" name="department" required>
                                    <option value="" disabled selected>Select Department</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Computer Engineering">Computer Engineering</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Tourism Management">Tourism Management</option>
                                    <option value="Hospitality Management">Hospitality Management</option>
                                    <option value="Business Administration">Business Administration</option>
                                    <option value="Accountancy">Accountancy</option>
                                    <option value="Education">Education</option>
                                    <option value="Criminology">Criminology</option>
                                </select>
                            </div>
                            <div class="mb-3" id="studentIDField">
                                <label for="studentID" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="studentID" name="studentID">
                            </div>
                            <div class="mb-3" id="companyField">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" readonly required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="user_type" class="form-label">User Type</label>
                                <select class="form-select" id="user_type" name="user_type" required>
                                    <option value="OJT Student">OJT Student</option>
                                    <option value="OJT Coordinator">OJT Coordinator</option>
                                    <option value="OJT Supervisor">OJT Supervisor</option>
                                    <option value="Registrar">Registrar</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Save User</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <!--START::ADD USER MODAL FUNCTION-->
        <script src="functions/add-users/user-type.js"></script>
        <script src="functions/add-users/email.js"></script>
        <script src="functions/add-users/studID.js"></script>
        <!--END::ADD USER MODAL FUNCTION-->

        <!--START::CRUD AJAX -->
        <script src="crud-ajax/manage-users/create-users.js"></script>

        <!--END::CRUD AJAX-->

    
        <!-- <script>
            $(document).ready(function() {
            $('#example').DataTable({
                // DataTable options go here
            });
        });
        </script>

        <script>
            $('#example').DataTable({
                responsive: true
            });
        </script>

        <script>
            $('#example').DataTable({
                serverSide: true,
                ajax: 'server-side-script.php'
            });
        </script>

        <script>
            $('#example').DataTable({
                columnDefs: [
                    {
                        targets: 5,
                        render: function (data, type, row) {
                            return '$' + data;
                        }
                    }
                ]
            });
        </script>

        <script>
            $('#example').DataTable({
                rowGroup: {
                    dataSrc: 2 // Index of the column to group by
                }
            });
        </script>

        <script>
            $('#example').DataTable({
                select: true
            });
        </script>
        
        <script>
            new $.fn.dataTable.FixedHeader($('#example').DataTable());
        </script> -->

        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    responsive: true,
                    serverSide: true,
                    ajax: 'controller/manage-user/retrieve-users.php',
                    columnDefs: [
                        {
                            targets: 5,
                            render: function (data, type, row) {
                                return '$' + data;
                            }
                        }
                    ],
                    rowGroup: {
                        dataSrc: 2 // Index of the column to group by
                    },
                    select: true
                });

                // Initialize FixedHeader
                new $.fn.dataTable.FixedHeader($('#example').DataTable());
            });

            $(document).ready(function() {
                $('#example').DataTable({
                    responsive: true
                });
            });
        </script>

        <script>
            // $(document).ready(function() {
            //     // Initialize DataTable
            //     $('#example').DataTable();

            //     // Fetch users data from the server
            //     function fetchUsers() {
            //         $.ajax({
            //             url: 'controller/manage-users/retrieve-users.php',
            //             type: 'GET',
            //             dataType: 'json',
            //             success: function(response) {
            //                 let tbody = '';
            //                 response.forEach(user => {
            //                     tbody += `
            //                         <tr>
            //                             <td>${user.firstname}</td>
            //                             <td>${user.lastname}</td>
            //                             <td>${user.department}</td>
            //                             <td>${user.studentID}</td>
            //                             <td>${user.company}</td>
            //                             <td>${user.email}</td>
            //                             <td>${user.password}</td>
            //                             <td>${user.user_type}</td>
            //                             <td>
            //                                 <!-- Add your action buttons here (Edit/Delete) -->
            //                                 <button class="btn btn-warning btn-sm">Edit</button>
            //                                 <button class="btn btn-danger btn-sm">Delete</button>
            //                             </td>
            //                         </tr>`;
            //                 });
            //                 $('#tdata').html(tbody);
            //                 $('#example').DataTable();
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error('Error fetching data:', error);
            //             }
            //         });
            //     }

            //     // Call the function to fetch user data
            //     fetchUsers();
            // });
        </script>

</body>

</html>