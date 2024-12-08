<div class="container-fluid bg-light p-0 m-0" id="departments" style="display: none;">
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Left section (Page Length and Search) -->
                <div class="d-flex align-items-center">
                    <!-- Page Length Selector -->
                    <div class="d-flex align-items-center me-3 mb-2 mb-sm-0">
                        <label for="depts-pageLengthSelect" class="form-label mb-0 me-2">Show</label>
                        <select id="depts-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Select number of entries per page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <!-- Search Input -->
                    <div class="ms-3 flex-shrink-1">
                        <div class="input-group">
                            <input type="text" id="depts-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-secondary btn-sm" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right section (Action buttons) -->
                <div class="d-flex">
                    <button class="btn btn-success btn-sm me-2" aria-label="Add Department" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                        Add Department
                    </button>
                    <button class="btn btn-success btn-sm me-2" aria-label="Assign Dean" data-bs-toggle="modal" data-bs-target="#assignDeanModal">
                        Assign Dean
                    </button>
                    <button class="btn btn-primary btn-sm me-2" aria-label="Edit Dean" data-bs-toggle="modal" data-bs-target="#editDeanModal" style="display: none;"> 
                        Edit Dean
                    </button>
                    <!-- <button class="btn btn-primary btn-sm me-2" aria-label="Edit selected users">Edit</button> -->
                    <!-- <button class="btn btn-danger btn-sm" aria-label="Delete selected users">Delete</button> -->
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="card-body bg-white">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="deptsTable" class="table table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <!-- Select All Checkbox -->
                                <input type="checkbox" id="selectAllCheckbox" aria-label="Select all users">
                            </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody id="dept-tdata">
                        <!-- Data will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="card-footer bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <span id="depts-tableInfo"></span>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul id="depts-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal Structure -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDepartmentForm">
                    <!-- Department Name Input -->
                    <div class="mb-3">
                        <label for="department_name" class="form-label">Department Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="department_name" name="department_name" required aria-describedby="departmentHelp" placeholder="Enter department name">
                    </div>

                    <!-- Submit Button -->
                    <div class="row ">
                        <div class="col-12 text-end">
                            <button type="submit" id="deptSubmitBtn" class="btn btn-success">
                                <i class="fa-solid fa-check-to-slot"></i> Submit
                            </button>
                            <button class="btn btn-primary me-2" id="editDeptBtn" aria-label="Edit Dept" data-bs-toggle="modal" data-bs-target="#editDeptModal">
                                Edit Department
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Assigning Dean -->
<div class="modal fade" id="assignDeanModal" tabindex="-1" aria-labelledby="assignDeanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignDeanModalLabel">Assign Dean</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignDeanForm">
                    <!-- Form content -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_last_name" name="last_name" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_first_name" name="first_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <label for="department1" class="form-label">Department 1<span class="text-danger">*</span></label>
                            <select class="form-select" id="add_department1" name="department1" required>
                                <option selected>Choose Department 1</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <label for="department2" class="form-label">Department 2<span class="text-danger"></span></label>
                            <select class="form-select" id="add_department2" name="department2">
                                <option selected>Choose Department 2</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <label for="department3" class="form-label">Department 3<span class="text-danger"></span></label>
                            <select class="form-select" id="add_department3" name="department3">
                                <option selected>Choose Department 3</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_username" name="username" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_password" name="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="deanSubmitBtn" class="btn btn-success">
                                <i class="fa-solid fa-check-to-slot"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure for Editing Department --> 
<div class="modal fade" id="editDeptModal" tabindex="-1" aria-labelledby="editDeptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeptModalLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDepartmentForm">
                    <!-- Dropdown for selecting a department -->
                    <div class="mb-3">
                        <label for="department_select" class="form-label">Select Department <span class="text-danger">*</span></label>
                        <select class="form-select" id="department_select" name="department_select" required>
                            <option value="" disabled selected>Select a department</option>
                        </select>
                    </div>

                    <!-- Department Name Input (editable field) -->
                    <div class="mb-3">
                        <label for="edit_department_name" class="form-label">Department Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_department_name" name="edit_department_name" required placeholder="Enter department name">
                    </div>

                    <!-- Update Button -->
                    <div class="d-flex justify-content-end">
                        <button type="button" id="editDeptUpdateBtn" class="btn btn-primary" disabled>
                            <i class="fa-solid fa-pen-to-square"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Dean -->
<div class="modal fade" id="editDeanModal" tabindex="-1" aria-labelledby="editDeanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeanModalLabel">Edit Dean</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDeanForm">
                    <!-- Last Name and First Name -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_last_name" name="last_name" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_first_name" name="first_name" required>
                        </div>
                    </div>

                    <!-- Department Selection -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <label for="dean_department" class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="update_dean_department" name="dean_department" required>
                                <option selected>Choose Department</option>
                                <!-- Department options will be dynamically populated -->
                            </select>
                        </div>
                    </div>

                    <!-- Username and Password -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_username" name="username" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_password" name="password" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="button" id="deanUpdateBtn" class="btn btn-primary">
                                <i class="fa-solid fa-check-to-slot"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>