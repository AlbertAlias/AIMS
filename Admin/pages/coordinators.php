<div class="container-fluid bg-light p-0 m-0" id="coordinators" style="display: none;">
    <div class="row g-3">
        <!-- Coordinators Section -->
        <div class="col-12 col-md-5 col-lg-3">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Coordinators</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchCoordinators" placeholder="Search Coordinator...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="coordinatorInfo" class="text-gray-800">
                    <!-- Coordinator information will be displayed here -->
                </div>
                <button id="addCoordinatorsBtn" data-id="1" class="btn btn-success mt-3">Add Coordinator</button>
            </div>
        </div>

        <!-- Add Coordinator Section -->
        <div class="col-12 col-md-7 col-lg-6">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Add Coordinator</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="coordinatorForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-12 col-md-5">
                            <input type="hidden" id="coorID" name="id">
                            <label for="coor_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_last_name" name="coor_last_name" required disabled>
                        </div>

                        <!-- First Name -->
                        <div class="col-12 col-md-7">
                            <label for="coor_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_first_name" name="coor_first_name" required disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Middle Name -->
                        <div class="col-12 col-md-4">
                            <label for="coor_middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="coor_middle_name" name="coor_middle_name" disabled>
                        </div>
                        <!-- Suffix -->
                        <div class="col-12 col-md-3">
                            <label for="coor_suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="coor_suffix" name="coor_suffix" disabled>
                        </div>
                        <!-- Civil Status -->
                        <div class="col-12 col-md-5">
                            <label for="coor_civil_status" class="form-label required-asterisk">Civil Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="coor_civil_status" name="coor_civil_status" required disabled>
                                <option selected disabled>Choose Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Address -->
                        <div class="col-12 col-md-6">
                            <label for="coor_address" class="form-label required-asterisk">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_address" name="coor_address" required disabled>
                        </div>
                        <!-- Email -->
                        <div class="col-12 col-md-6">
                            <label for="coor_personal_email" class="form-label required-asterisk">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="coor_personal_email" name="coor_personal_email" required disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="coor_employee_number" class="form-label required-asterisk">Employee Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_employee_number" name="coor_employee_number" required disabled>
                        </div>
                        <!-- Department -->
                        <div class="col-12 col-md-6">
                            <label for="coor_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="coor_department" name="coor_department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="button" id="coorCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                            <button type="button" id="coorDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                            <button type="button" id="coorUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                            <button type="submit" id="coorSubmitBtn" class="btn btn-success" disabled><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Information Section -->
        <div class="col-12 col-md-12 col-lg-3">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Account Information</h5>
                <div class="text-gray-800">
                    <form id="coor_accountForm">
                        <div class="mb-3">
                            <label for="coor_account_email" class="form-label required-asterisk">Account Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="coor_account_email" name="coor_account_email" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="coor_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="coor_password" name="coor_password" required disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>