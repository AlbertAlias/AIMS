<div class="container-fluid bg-light p-0 m-0" id="supervisors" style="display: none;">
    <div class="row g-3">
        <!-- Supervisor Section -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Supervisors</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchSupervisors" placeholder="Search Supervisor...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="supervisorInfo" class="text-gray-800">
                    <!-- Supervisor information will be displayed here -->
                </div>
            </div>
        </div>

        <!-- Add Supervisor Section -->
        <div class="col-12 col-md-6 col-lg-8">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Add Supervisor</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="visorForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-12 col-md-4">
                            <input type="hidden" id="visorID" name="id">
                            <label for="visor_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visor_last_name" name="visor_last_name" required>
                        </div>
                        <!-- First Name -->
                        <div class="col-12 col-md-4">
                            <label for="visor_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visor_first_name" name="visor_first_name" required>
                        </div>
                        <!-- Middle Name -->
                        <div class="col-12 col-md-4">
                            <label for="visor_middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="visor_middle_name" name="visor_middle_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Gender -->
                        <div class="col-12 col-md-3">
                            <label for="visor_gender" class="form-label required-asterisk">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="visor_gender" name="visor_gender" required>
                                <option selected>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <!-- Email -->
                        <div class="col-12 col-md-4">
                            <label for="visor_personal_email" class="form-label required-asterisk">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="visor_personal_email" name="visor_personal_email" required>
                        </div>
                        <!-- Company -->
                        <div class="col-12 col-md-5">
                            <label for="visor_company_name" class="form-label required-asterisk">Company Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visor_company_name" name="visor_company_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Company Address -->
                        <div class="col-12 col-md-4">
                            <label for="visor_company_address" class="form-label">Company Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visor_company_address" name="visor_company_address" required>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="visor_username" class="form-label required-asterisk">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visor_username" name="visor_username" required>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="visor_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="visor_password" name="visor_password" required>
                        </div>
                    </div>
                    <button type="submit" id="visorSubmitBtn" class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="visorUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="visorCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                    <button type="button" id="visorDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>