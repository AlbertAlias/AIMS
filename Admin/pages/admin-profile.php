<div class="container-fluid p-0 m-0" id="profile" style="display: none;">
    <!-- User Information Section -->
    <div class="col-md-9 col-12">
        <div class="bg-light rounded-3 px-2" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row">
                <!-- Profile Picture Section on the Left Side -->
                <div class="col-md-4 d-flex flex-column align-items-center py-4" style="border-right: 2px solid #ddd;">
                    <div style="position: relative;">
                        <img id="profile-picture" src="" alt="Profile Picture" class="rounded-circle" style="display: none; width: 148px; height: 145px; object-fit: cover;">
                        <span id="profile-initials-placeholder" class="initials-placeholder" style="display: none;"></span>
                        <i class="fa-solid fa-camera" id="camera-icon" data-user-id="<?php echo $_SESSION['user_id']; ?>" style="position: absolute; bottom: 8px; right: 6px; font-size: 20px; color: white; background-color: dimgray; border-radius: 50%; padding: 6px;"></i>
                        <input type="file" id="profile-picture-input" accept="image/png, image/jpeg" style="display: none;">
                    </div>

                    <!-- Sidebar Navigation -->
                    <div class="mt-3 w-100">
                        <div class="list-group">
                            <a href="#profile-info" class="list-group-item list-group-item-action active">Profile</a>
                            <a href="#account-info" class="list-group-item list-group-item-action">Account</a>
                        </div>
                    </div>
                </div>

                <!-- Form Section on the Right Side -->
                <div class="col-md-8 py-3">
                    <!-- Personal Information Section -->
                    <div id="profile-info" style="display: block;">
                        <h6 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Personal Information</h6>
                        <form>
                            <div class="mt-2 mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="user-name">
                                    <i class="fa-solid fa-user fa-lg" style="color: #198754;"></i>
                                    <span id="users-name"></span>
                                </label>
                                <button type="button" id="namEditBtn" class="btn btn-sm btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                                <button type="submit" id="nameUpdateBtn" class="btn btn-sm btn-primary" style="display: none;"><i class="fa-solid fa-check-to-slot"></i> Save</button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="location">
                                    <i class="fa-solid fa-location-dot fa-lg" style="color: #198754;"></i>
                                    <span id="users-location"></span>
                                </label>
                                <button type="button" id="locEditBtn" class="btn btn-sm btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                                <button type="submit" id="locUpdateBtn" class="btn btn-sm btn-primary" style="display: none;"><i class="fa-solid fa-check-to-slot"></i> Save</button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="civil-status">
                                    <i class="fa-solid fa-heart fa-lg" style="color: #198754;"></i>
                                    <span id="users-civil-status"></span>
                                </label>
                                <button type="button" id="civilEditBtn" class="btn btn-sm btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                                <button type="submit" id="civilUpdateBtn" class="btn btn-sm btn-primary" style="display: none;"><i class="fa-solid fa-check-to-slot"></i> Save</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label" for="email">
                                    <i class="fa-solid fa-envelope fa-lg" style="color: #198754;"></i>
                                    <span id="users-email"></span>
                                </label>
                                <button type="button" id="emailEditBtn" class="btn btn-sm btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                                <button type="submit" id="emailUpdateBtn" class="btn btn-sm btn-primary" style="display: none;"><i class="fa-solid fa-check-to-slot"></i> Save</button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Change Section -->
                    <div id="account-info" style="display: none;">
                        <h6 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Settings</h6>
                        <form>
                            <!-- Account Email (New Section) -->
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="account-email" style="flex-grow: 1;">
                                    <i class="fa-solid fa-envelope fa-lg" style="color: #198754;"></i>
                                    <span id="users-account-email"></span>
                                    <input type="email" id="account-email-input" class="form-control form-control-sm" style="display: none;" value="">
                                </label>
                                <button type="button" id="editAccountEmailBtn" class="btn btn-sm btn-success"><i class="fa-solid fa-pen"></i> Edit</button>
                                <button type="submit" id="saveAccountEmailBtn" class="btn btn-sm btn-primary" style="display: none;"><i class="fa-solid fa-check"></i> Save</button>
                            </div>

                            <!-- Password Settings -->
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">
                                    <i class="fa-solid fa-key fa-lg" style="color: #198754;"></i> 
                                    <span class="password-dots">●●●●●●●●●●</span>
                                </label>
                                <button type="button" id="changePasswordBtn" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-pen fa-lg me-1"></i> Change Password
                                </button>
                            </div>

                            <!-- Hidden Password Input Fields -->
                            <div id="passwordFields" style="display: none;">
                                <!-- Old Password (not full width) -->
                                <div class="mb-2">
                                    <label for="oldPassword" class="form-label small">Old Password</label>
                                    <input type="password" id="oldPassword" class="form-control form-control-sm w-75"> <!-- Reduced width to 75% -->
                                </div>

                                <!-- New Password and Confirm Password side by side -->
                                <div class="row g-2">
                                    <div class="col">
                                        <label for="newPassword" class="form-label small">New Password</label>
                                        <input type="password" id="newPassword" class="form-control form-control-sm">
                                    </div>
                                    <div class="col">
                                        <label for="confirmPassword" class="form-label small">Confirm Password</label>
                                        <input type="password" id="confirmPassword" class="form-control form-control-sm">
                                    </div>
                                </div>
                                
                                <!-- Button Container -->
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="button" id="passCancelBtn" class="btn btn-secondary me-2"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                                    <button type="submit" id="passSubmitBtn" class="btn btn-primary"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <form id="editProfileForm">
    <div class="row mb-3">
        <div class="col-md-5">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="" required>
        </div>
        <div class="col-md-7">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-5">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="">
        </div>
        <div class="col-md-3">
            <label for="suffix" class="form-label">Suffix</label>
            <input type="text" class="form-control" id="suffix" name="suffix" value="">
        </div>
        <div class="col-md-4">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="" required>
        </div>
        <div class="col-md-4">
            <label for="civil_status" class="form-label">Civil Status</label>
            <select class="form-select" id="civil_status" name="civil_status">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="tel" class="form-control" id="contact_number" name="contact_number" pattern="[0-9]{10}" maxlength="10" required>
        </div>
    </div>

    <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="account_email" class="form-label">Account Email</label>
            <input type="email" class="form-control" id="account_email" name="account_email" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="col-md-6">
            <label for="user_type" class="form-label">Role</label>
            <select class="form-select" id="user_type" name="user_type">
                <option value="admin">Admin</option>
                <option value="sub-admin">Sub-admin</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-end">
            <button type="button" class="btn btn-secondary" id="cancelEdit"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-check-to-slot"></i> Save</button>
            <button type="button" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
        </div>
    </div>
</form> -->