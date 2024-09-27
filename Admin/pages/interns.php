<div class="container-fluid bg-light p-0 m-0" id="interns" style="display: none;">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Interns</h5>
                <div id="internsInfo" class="text-gray-800">
                    <!-- Intern information will be displayed here -->
                </div>
                <button id="addInternsBtn" data-id="1" class="btn btn-success mt-3">Add Interns</button>
            </div>
        </div>

        <!-- Middle rectangle container -->
        <div class="col-md-4 col-lg-6">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Interns</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="internsForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-md-5">
                            <input type="hidden" id="internID" name="id">
                            <label for="intern_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_last_name" name="intern_last_name" required disabled>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-7">
                            <label for="intern_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_first_name" name="intern_first_name" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Middle Name -->
                        <div class="col-md-5">
                            <label for="intern_middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="intern_middle_name" name="intern_middle_name" disabled>
                        </div>
                        <!-- Suffix -->
                        <div class="col-md-3">
                            <label for="intern_suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="intern_suffix" name="intern_suffix" disabled>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-4">
                            <label for="intern_gender" class="form-label required-asterisk">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_gender" name="intern_gender" required disabled>
                                <option selected disabled>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Address -->
                        <div class="col-md-8">
                            <label for="intern_address" class="form-label required-asterisk">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_address" name="intern_address" required disabled>
                        </div>
                        <!-- Birthdate -->
                        <div class="col-md-4">
                            <label for="intern_birthdate" class="form-label required-asterisk">Birthdate <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="intern_birthdate" name="intern_birthdate" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Civil Status -->
                        <div class="col-md-4">
                            <label for="intern_civil_status" class="form-label required-asterisk">Civil Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_civil_status" name="intern_civil_status" required disabled>
                                <option selected disabled>Choose Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <!-- Email -->
                        <div class="col-md-8">
                            <label for="intern_personal_email" class="form-label required-asterisk">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="intern_personal_email" name="intern_personal_email" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3 border-bottom border-dark pb-3 mb-2">
                        <!-- Contact Number -->
                        <div class="col-md-4">
                            <label for="intern_contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text m-0 px-2">+63</span>
                                <input type="tel" class="form-control" id="intern_contact_number" name="intern_contact_number" placeholder="" pattern="[1-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" required disabled>
                            </div>
                        </div>
                        <!-- Student ID -->
                        <div class="col-md-3">
                            <label for="studentID" class="form-label">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="studentID" name="studentID" required disabled>
                        </div>
                        <!-- Department -->
                        <div class="col-md-5">
                            <label for="intern_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_department" name="intern_department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>

                    <p class="text-gray-800 fs-5 mb-3">Internship Information</p>

                    <div class="row mb-3">
                        <!-- Coordinator Name -->
                        <div class="col-md-8">
                            <label for="coordinatorName" class="form-label required-asterisk">Coordinator Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coordinator_name" name="coordinator_name" required disabled>
                        </div>

                        <!-- Hours Needed -->
                        <div class="col-md-4">
                            <label for="hoursNeeded" class="form-label required-asterisk">Hours Needed <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="hours_needed" name="hours_needed" required disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Coordinator Email -->
                        <div class="col-md-7">
                            <label for="coordinatorEmail" class="form-label required-asterisk">Coordinator Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="coordinator_email" name="coordinator_email" required disabled>
                        </div>

                        <!-- Internship Status -->
                        <div class="col-md-5">
                            <label for="internship_status" class="form-label required-asterisk">Internship Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="internship_status" name="internship_status" required disabled>
                                <option selected disabled>Select Internship Status</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" id="internCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                            <button type="button" id="internUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                            <button type="submit" id="internSubmitBtn" class="btn btn-success" disabled><i class="fa-solid fa-check-to-slot"></i> Submit</button>
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
                    <form id="intern_accountForm">
                        <div class="mb-3">
                            <label for="intern_account_email" class="form-label required-asterisk">Account Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="intern_account_email" name="intern_account_email" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="intern_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="intern_password" name="intern_password" required disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>