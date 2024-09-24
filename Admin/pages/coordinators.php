<div class="container-fluid bg-light p-0 m-0" id="coordinators" style="display: none;">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Coordinators</h5>
                <div id="coordinatorInfo" class="text-gray-800">
                    <!-- Coordinator information will be displayed here -->
                </div>
                <button id="addCoordinatorsBtn" data-id="1" class="btn btn-success mt-3">Add Coordinator</button>
            </div>
        </div>

        <!-- Middle rectangle container -->
        <div class="col-md-4 col-lg-6">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Coordinator</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="coordinatorForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-md-5">
                            <input type="hidden" id="coordinatorId" name="coordinatorId">
                            <label for="coor_last_name" class="form-label required-asterisk">Last Name</label>
                            <input type="text" class="form-control" id="coor_last_name" name="coor_last_name" required disabled>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-7">
                            <label for="coor_first_name" class="form-label required-asterisk">First Name</label>
                            <input type="text" class="form-control" id="coor_first_name" name="coor_first_name" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Middle Name -->
                        <div class="col-md-5">
                            <label for="coor_middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="coor_middle_name" name="coor_middle_name" disabled>
                        </div>
                        <!-- Suffix -->
                        <div class="col-md-3">
                            <label for="coor_suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="coor_suffix" name="coor_suffix" disabled>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-4">
                            <label for="coor_gender" class="form-label required-asterisk">Gender</label>
                            <select class="form-select" id="coor_gender" name="coor_gender" required disabled>
                                <option selected disabled>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Address -->
                        <div class="col-md-8">
                            <label for="coor_address" class="form-label required-asterisk">Address</label>
                            <input type="text" class="form-control" id="coor_address" name="coor_address" required disabled>
                        </div>
                        <!-- Birthdate -->
                        <div class="col-md-4">
                            <label for="coor_birthdate" class="form-label required-asterisk">Birthdate</label>
                            <input type="date" class="form-control" id="coor_birthdate" name="coor_birthdate" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Civil Status -->
                        <div class="col-md-4">
                            <label for="coor_civil_status" class="form-label required-asterisk">Civil Status</label>
                            <select class="form-select" id="coor_civil_status" name="coor_civil_status" required disabled>
                                <option selected disabled>Choose Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <!-- Email -->
                        <div class="col-md-8">
                            <label for="coor_personal_email" class="form-label required-asterisk">Email</label>
                            <input type="email" class="form-control" id="coor_personal_email" name="coor_personal_email" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Contact Number -->
                        <div class="col-md-5">
                            <label for="coor_contact_number" class="form-label">Contact Number</label>
                            <div class="input-group">
                                <span class="input-group-text m-0 px-2">+63</span>
                                <input type="tel" class="form-control" id="coor_contact_number" name="coor_contact_number" placeholder="" pattern="[1-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" disabled>
                            </div>
                        </div>
                        <!-- Department -->
                        <div class="col-md-7">
                            <label for="coor_department" class="form-label required-asterisk">Department</label>
                            <select class="form-select" id="coor_department" name="coor_department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" id="coorCancelBtn" class="btn btn-secondary" style="display: none;">Cancel</button>
                            <button type="button" id="coorDeleteBtn" class="btn btn-danger" style="display: none;">Delete</button>
                            <button type="button" id="coorUpdateBtn" class="btn btn-primary" style="display: none;">Update</button>
                            <button type="submit" id="coorSubmitBtn" class="btn btn-success" disabled>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
                <div class="text-gray-800">
                    <form id="coor_accountForm">
                        <div class="mb-3">
                            <label for="coor_account_email" class="form-label required-asterisk">Account Email</label>
                            <input type="email" class="form-control" id="coor_account_email" name="coor_account_email" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="coor_password" class="form-label required-asterisk">Password</label>
                            <input type="password" class="form-control" id="coor_password" name="coor_password" required disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>