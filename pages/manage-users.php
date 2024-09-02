<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTables Example  style="max-width: 90%; margin: 0 auto; padding: 5px; left: -5%;"-->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="font-weight-bold text-primary mb-0">Manage Users</h6>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fa-solid fa-user-plus"></i> Add User</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" cellspacing="0" style="width:100%">
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
                    <tbody id="tdata"></tbody>
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
                            <!-- <option value="OJT Student">OJT Student</option>
                            <option value="OJT Coordinator">OJT Coordinator</option>
                            <option value="OJT Supervisor">OJT Supervisor</option>
                            <option value="Registrar">Registrar</option> -->
                            <?php
                                // Exclude admin from the dropdown
                                $user_types = ['OJT Student', 'OJT Coordinator', 'OJT Supervisor', 'Registrar'];
                                foreach ($user_types as $type) {
                                    echo "<option value=\"$type\">$type</option>";
                                }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="addUserForm" class="btn btn-primary">Save User</button>
            </div>
        </div>
    </div>
</div>