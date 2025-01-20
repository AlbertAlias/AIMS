<div class="container-fluid bg-light p-0 m-0" id="departments" style="display: none;">
    <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bg-light rounded-3 p-3 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-2">Departments</h5>
                <div class="mb-2 position-relative">
                    <input type="text" class="form-control" id="searchDepartments">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                    </svg>
                </div>
                <div id="deanInfo" class="text-gray-800">
                    <!-- Department information will be displayed here -->
                </div>
                <div class="container rounded bg-success p-2 mt-2 text-center text-white">Dean Lists</div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-8">
            <div class="bg-light rounded-3 p-3 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-2">Add Department</h5>
                <form id="addDepartmentForm">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <input type="hidden" id="deptID" name="id">
                            <label for="department_name" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="department_name" name="department_name" required aria-describedby="departmentHelp">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="department_image" class="form-label">Department Image</label>
                            <input type="file" class="form-control" id="department_image" name="department_image" accept="image/*">
                        </div>
                    </div>
                    <button type="submit" id="deptSubmitBtn" class="btn btn-success me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M96 80c0-26.5 21.5-48 48-48l288 0c26.5 0 48 21.5 48 48l0 304L96 384 96 80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48l16 0 0 128 448 0 0-128 16 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48L48 480c-26.5 0-48-21.5-48-48l0-96z"/>
                        </svg> Submit
                    </button>

                    <button type="button" id="seeDepartmentsBtn" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#seeDepartmentsModal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                        </svg>
                        Departments
                    </button>
                </form>
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-2 mt-3">Assign Dean</h5>
                <form id="assignDeanForm">
                    <div class="row mb-1">
                        <div class="col-12 col-md-4">
                            <input type="hidden" id="deanID" name="deanID">
                            <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-2" id="add_last_name" name="last_name" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-2" id="add_first_name" name="first_name" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="department1" class="form-label">Department 1<span class="text-danger">*</span></label>
                            <select class="form-select mb-2" id="add_department1" name="department1" required>
                                <option selected>Choose Department 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12 col-md-6">
                            <label for="department2" class="form-label">Department 2<span class="text-danger"></span></label>
                            <select class="form-select mb-2" id="add_department2" name="department2">
                                <option selected>Choose Department 2</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="department3" class="form-label">Department 3<span class="text-danger"></span></label>
                            <select class="form-select mb-2" id="add_department3" name="department3">
                                <option selected>Choose Department 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mb-2" id="add_username" name="username" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control mb-2" id="add_password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" id="deanSubmitBtn" class="btn btn-success me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M96 80c0-26.5 21.5-48 48-48l288 0c26.5 0 48 21.5 48 48l0 304L96 384 96 80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48l16 0 0 128 448 0 0-128 16 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48L48 480c-26.5 0-48-21.5-48-48l0-96z"/>
                        </svg> Submit
                    </button>
                    <button type="button" id="deanUpdateBtn" class="btn btn-primary" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                        </svg> Update
                    </button>
                    <button type="button" id="deanCancelBtn" class="btn btn-secondary" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M48.5 224L40 224c-13.3 0-24-10.7-24-24L16 72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8L48.5 224z"/>
                        </svg> Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="seeDepartmentsModal" tabindex="-1" aria-labelledby="seeDepartmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seeDepartmentsModalLabel">Departments List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <select id="departmentSelect" class="form-select">
                        <option selected>Choose a department</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="department_name" class="form-label">Edit Department</label>
                    <input type="text" id="update_department_name" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="department_image" class="form-label">Department Image</label>
                    <input type="file" class="form-control" id="update_department_image" name="department_image" accept="image/*">
                    <div id="currentImageName" class="alert alert-info mt-2" role="alert" style="display: none;"></div>
                </div>
                <button type="button" id="deptUpdateBtn" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                    </svg> Update
                </button>
                <button type="button" id="deptDeleteBtn" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg> Delete
                </button>
            </div>
        </div>
    </div>
</div>