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
                        <i class="fa-solid fa-camera" id="user-profile" data-user-id="<?php echo $_SESSION['user_id']; ?>" style="position: absolute; bottom: 8px; right: 6px; font-size: 20px; color: white; background-color: dimgray; border-radius: 50%; padding: 6px;"></i>
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
                                <button type="button" id="nameEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editNameModal">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="location">
                                    <i class="fa-solid fa-location-dot fa-lg" style="color: #198754;"></i>
                                    <span id="users-location"></span>
                                </label>
                                <button type="button" id="locEditBtn" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="civil-status">
                                    <i class="fa-solid fa-heart fa-lg" style="color: #198754;"></i>
                                    <span id="users-civil-status"></span>
                                </label>
                                <button type="button" id="civilEditBtn" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label" for="email">
                                    <i class="fa-solid fa-envelope fa-lg" style="color: #198754;"></i>
                                    <span id="users-email"></span>
                                </label>
                                <button type="button" id="emailEditBtn" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
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
                                <button type="button" id="changePasswordBtn" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-key fa-lg"></i> Change Password
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

<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editNameForm">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="firstName" placeholder="First Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="middleName" placeholder="Middle Name">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-sm btn-primary" id="updateNameBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="locationInput" class="form-control" placeholder="Enter new location">
                </div>
                <div class="text-end">
                    <button type="button" id="locUpdateBtn" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCivilStatusModal" tabindex="-1" aria-labelledby="editCivilStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCivilStatusModalLabel">Edit Civil Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="civilStatusInput" class="form-control" placeholder="Enter new civil status">
                </div>
                <div class="text-end">
                    <button type="button" id="saveCivilStatusBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="emailEditModal" tabindex="-1" aria-labelledby="emailEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailEditModalLabel">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="emailEditForm">
                    <div class="mb-3">
                        <!-- Input field for email -->
                        <input type="email" class="form-control" id="newEmail" required>
                    </div>
                    <div class="text-end">
                        <button type="button" id="updateEmailBtn" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3 position-relative">
                        <label for="modalOldPassword" class="form-label">Old Password</label>
                        <input type="password" id="modalOldPassword" class="form-control">
                        <span id="oldPasswordFeedback" class="position-absolute"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalNewPassword" class="form-label">New Password</label>
                        <input type="password" id="modalNewPassword" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="modalConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" id="modalConfirmPassword" class="form-control">
                        <span id="passwordFeedback" class="position-absolute"></span>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>