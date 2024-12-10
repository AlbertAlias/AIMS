<div class="container-fluid bg-light p-0 m-0" id="departments" style="display: none;">
    <div class="row g-4">
        <!-- Left square container (smaller width) -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bg-light rounded-3 p-4 d-flex flex-column position-relative" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Departments</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchDepartments" placeholder="Search Department...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="deanInfo" class="text-gray-800">
                    <!-- Department information will be displayed here -->
                </div>
                <button id="addDepartmentsBtn" class="btn btn-success mt-3">See table lists</button>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-8">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 150px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Department</h5>
                <form id="addDepartmentForm">
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <input type="hidden" id="deptID" name="id">
                            <label for="department_name" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="department_name" name="department_name" required aria-describedby="departmentHelp">
                        </div>
                    </div>
                    <button type="submit" id="deptSubmitBtn" class="btn btn-success me-2"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="deptUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="deptDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                    <button type="button" id="deptCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                </form>
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3 mt-3">Assign Dean</h5>
                <form id="assignDeanForm">
                    <!-- Form content -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <input type="hidden" id="deanID" name="deanID">
                            <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_last_name" name="last_name" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_first_name" name="first_name" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="department1" class="form-label">Department 1<span class="text-danger">*</span></label>
                            <select class="form-select" id="add_department1" name="department1" required>
                                <option selected>Choose Department 1</option>
                                <!-- Populate department options dynamically -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="department2" class="form-label">Department 2<span class="text-danger"></span></label>
                            <select class="form-select" id="add_department2" name="department2">
                                <option selected>Choose Department 2</option>
                                <!-- Populate department options dynamically -->
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="department3" class="form-label">Department 3<span class="text-danger"></span></label>
                            <select class="form-select" id="add_department3" name="department3">
                                <option selected>Choose Department 3</option>
                                <!-- Populate department options dynamically -->
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
                            <input type="password" class="form-control" id="add_password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" id="deanSubmitBtn" class="btn btn-success me-2"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="deanUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="deanCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>