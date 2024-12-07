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
                <div id="departmentInfo" class="text-gray-800">
                    <!-- Department information will be displayed here -->
                </div>
                <button id="addDepartmentsBtn" class="btn btn-success mt-3">Add Departments</button>
            </div>
        </div>

        <!-- Middle Container (larger width) -->
        <div class="col-12 col-md-6 col-lg-8">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 150px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Department</h5>
                <form id="departmentForm">
                    <input type="hidden" id="departmentId" name="id">
                    <div class="row mb-3">
                        <div class="col-12 col-md-12">
                            <label for="department_name" class="form-label">Department name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="department_name" name="department_name" required disabled>
                        </div>
                    </div>
                    <button type="submit" id="deptSubmitBtn" class="btn btn-success me-2" disabled><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="deptUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="deptDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                    <button type="button" id="deptCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                </form>

                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3 mt-3">Add Department Dean</h5>
                <p class="text-gray-800 fs-5 mb-3">Department Dean Information</p>
                <form id="deanForm">
                    <input type="hidden" id="deanId" name="id">
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <label for="last_name" class="form-label">Dean Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required disabled>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="first_name" class="form-label">Dean First name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required disabled>
                        </div>
                        <!-- Department -->
                        <div class="col-12 col-md-4">
                            <label for="dean_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="dean_department" name="dean_department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required disabled>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password" required disabled>
                        </div>
                    </div>
                    <button type="submit" id="deanSubmitBtn" class="btn btn-success me-2" disabled><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="deanUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="deanDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                    <button type="button" id="deanCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>