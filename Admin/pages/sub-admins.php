<div class="container-fluid bg-light p-0 m-0" id="sub-admins" style="display: none;">
    <div class="row g-4">
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Admins</h5>
                <div id="adminsInfo" class="text-gray-800">
                    <!-- Admin information will be displayed here -->
                </div>
                <button id="addAdminsBtn" data-id="1" class="btn btn-success mt-3">Add Admin</button>
            </div>
        </div>

        <div class="col-md-4 col-lg-6">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Admin</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="adminsForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-md-5">
                            <input type="hidden" id="adminID" name="id">
                            <label for="admin_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="admin_last_name" name="admin_last_name" required disabled>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-7">
                            <label for="admin_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="admin_first_name" name="admin_first_name" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Middle Name -->
                        <div class="col-md-5">
                            <label for="admin_middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="admin_middle_name" name="admin_middle_name" disabled>
                        </div>
                        <!-- Suffix -->
                        <div class="col-md-3">
                            <label for="admin_suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="admin_suffix" name="admin_suffix" disabled>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-4">
                            <label for="admin_gender" class="form-label required-asterisk">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="admin_gender" name="admin_gender" required disabled>
                                <option selected disabled>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Address -->
                        <div class="col-md-12">
                            <label for="admin_address" class="form-label required-asterisk">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="admin_address" name="admin_address" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Birthdate -->
                        <div class="col-md-4">
                            <label for="admin_birthdate" class="form-label required-asterisk">Birthdate <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="admin_birthdate" name="admin_birthdate" required disabled>
                        </div>
                        <!-- Civil Status -->
                        <div class="col-md-4">
                            <label for="admin_civil_status" class="form-label required-asterisk">Civil Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="admin_civil_status" name="admin_civil_status" required disabled>
                                <option selected disabled>Choose Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <!-- Contact Number -->
                        <div class="col-md-4">
                            <label for="admin_contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text m-0 px-2">+63</span>
                                <input type="tel" class="form-control" id="admin_contact_number" name="admin_contact_number" placeholder="" pattern="[1-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" required disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Email -->
                        <div class="col-md-12">
                            <label for="admin_personal_email" class="form-label required-asterisk">Personal Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="admin_personal_email" name="admin_personal_email" required disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" id="adminCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                            <button type="button" id="adminUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                            <button type="submit" id="adminSubmitBtn" class="btn btn-success" disabled><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
                <div class="text-gray-800">
                    <form id="admin_accountForm">
                        <div class="mb-3">
                            <label for="admin_account_email" class="form-label required-asterisk">Account Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="admin_account_email" name="admin_account_email" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="admin_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="admin_password" name="admin_password" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label required-asterisk">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required disabled>
                                <option selected disabled>Choose Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Sub-Admin">Sub-admin</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>