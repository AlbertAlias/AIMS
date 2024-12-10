<div class="container-fluid bg-light p-0 m-0" id="coordinators" style="display: none;">
    <div class="row g-3">
        <!-- Coordinators Section -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Coordinators</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchCoordinators" placeholder="Search Coordinator...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="coordinatorInfo" class="text-gray-800">
                    <!-- Coordinator information will be displayed here -->
                </div>
                <button id="addCoordinatorsBtn" data-id="1" class="btn btn-success mt-3">See table lists</button>
            </div>
        </div>

        <!-- Add Coordinator Section -->
        <div class="col-12 col-md-6 col-lg-8">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Add Coordinator</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="coordinatorForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-12 col-md-4">
                            <input type="hidden" id="coorID" name="id">
                            <label for="coor_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_last_name" name="coor_last_name" required>
                        </div>
                        <!-- First Name -->
                        <div class="col-12 col-md-4">
                            <label for="coor_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_first_name" name="coor_first_name" required>
                        </div>
                        <!-- Middle Name -->
                        <div class="col-12 col-md-4">
                            <label for="coor_middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="coor_middle_name" name="coor_middle_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Email -->
                        <div class="col-12 col-md-6">
                            <label for="coor_personal_email" class="form-label required-asterisk">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="coor_personal_email" name="coor_personal_email" required>
                        </div>
                        <!-- Department -->
                        <div class="col-12 col-md-6">
                            <label for="coor_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="coor_department" name="coor_department" required>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="coor_username" class="form-label required-asterisk">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coor_username" name="coor_username" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="coor_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="coor_password" name="coor_password" required>
                        </div>
                    </div>
                    <button type="submit" id="coorSubmitBtn" class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="coorUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="coorCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                    <button type="button" id="coorDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>