<div class="container-fluid bg-light p-0 m-0" id="departments" style="display: none;">
    <div class="row g-4">
        <!-- Left square container (smaller width) -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column position-relative" style="min-height: 300px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Departments</h5>
                <div id="departmentInfo" class="text-gray-800">
                    <!-- Department information will be displayed here -->
                </div>
                <button id="addDepartmentsBtn" class="btn btn-success mt-3">Add Departments</button>
            </div>
        </div>
        <!-- Right rectangle container (larger width) -->
        <div class="col-md-8 col-lg-9">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 300px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Department</h5>
                <p class="text-gray-800 fs-5 mb-3">Department Information</p>
                <form id="departmentForm">
                    <input type="hidden" id="departmentId" name="id"> <!-- Hidden input for department ID -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="departmentName" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="departmentName" name="departmentName" required disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="departmentHead" class="form-label">Department Head <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="departmentHead" name="departmentHead" required disabled>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button type="button" id="updateBtn" class="btn btn-primary" style="display: none;">Update</button>
                    <button type="button" id="cancelEditBtn" class="btn btn-secondary" style="display: none;">Cancel</button>
                    <button type="button" id="deleteDeptBtn" class="btn btn-danger" style="display: none;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>