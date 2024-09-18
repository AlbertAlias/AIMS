<div class="container-fluid bg-light p-0 m-0">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow-sm px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Coordinators</h5>
                <div id="coordinatorInfo" class="text-gray-800">
                    <!-- Coordinator information will be displayed here -->
                </div>
                <button id="addCoordinatorsBtn" data-id="1" class="btn btn-success mt-3">Add Coordinator</button>
            </div>
        </div>

        <!-- Middle rectangle container -->
        <div class="col-md-4 col-lg-6">
            <div class="bg-light rounded-3 shadow-sm px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Coordinator</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="coordinatorForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-md-5">
                            <input type="hidden" id="coordinator_id" name="id">
                            <label for="lastName" class="form-label required-asterisk">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required disabled>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-7">
                            <label for="firstName" class="form-label required-asterisk">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Middle Name -->
                        <div class="col-md-5">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" disabled>
                        </div>
                        <!-- Suffix -->
                        <div class="col-md-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix" disabled>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-4">
                            <label for="gender" class="form-label required-asterisk">Gender</label>
                            <select class="form-select" id="gender" name="gender" required disabled>
                                <option selected disabled>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Address -->
                        <div class="col-md-8">
                            <label for="address" class="form-label required-asterisk">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required disabled>
                        </div>
                        <!-- Birthdate -->
                        <div class="col-md-4">
                            <label for="birthdate" class="form-label required-asterisk">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Civil Status -->
                        <div class="col-md-4">
                            <label for="civilStatus" class="form-label required-asterisk">Civil Status</label>
                            <select class="form-select" id="civil_status" name="civil_status" required disabled>
                                <option selected disabled>Choose Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <!-- Email -->
                        <div class="col-md-8">
                            <label for="personalEmail" class="form-label required-asterisk">Email</label>
                            <input type="email" class="form-control" id="personal_email" name="personal_email" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Contact Number -->
                        <div class="col-md-5">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <div class="input-group">
                                <span class="input-group-text m-0 px-2">+63</span>
                                <input type="tel" class="form-control" id="contact_number" name="contact_number" placeholder="" pattern="[1-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" disabled>
                            </div>
                        </div>
                        <!-- Department -->
                        <div class="col-md-7">
                            <label for="department" class="form-label required-asterisk">Department</label>
                            <select class="form-select" id="department" name="department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" id="cancelBtn" class="btn btn-secondary" style="display: none;">Cancel</button>
                            <button type="button" id="updateBtn" class="btn btn-primary" style="display: none;">Update</button>
                            <button type="submit" id="submitBtn" class="btn btn-success" disabled>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 shadow-sm px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
                <div class="text-gray-800">
                    <form id="accountInfoForm">
                        <div class="mb-3">
                            <label for="accountEmail" class="form-label required-asterisk">Account Email</label>
                            <input type="email" class="form-control" id="account_email" name="account_email" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label required-asterisk">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>