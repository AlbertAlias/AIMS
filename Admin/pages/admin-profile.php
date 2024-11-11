<div class="container-fluid p-0 m-0" id="profile" style="display: none;">
    <!-- User Information Section -->
    <div class="col-md-9 col-12">
        <div class="bg-light rounded-3 px-2" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row">
                <div class="col-md-4 d-flex flex-column align-items-center py-4" style="border-right: 2px solid #ddd;">
                    <div class="profile-wrapper" style="position: relative;">
                        <div id="profile-picture-container">
                            <i class="fa-solid fa-user" id="default-profile-icon" style="color: gray;"></i>
                            <img id="profile-picture" src="" alt="Profile Picture" class="rounded-circle" style="display: none;">
                        </div>
                        <i class="fa-solid fa-camera" id="user-profile" data-user-id="<?php echo $_SESSION['user_id']; ?>"></i>
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
                                <label class="form-label" for="name">
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
                                <button type="button" id="locEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editLocationModal">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="civil-status">
                                    <i class="fa-solid fa-heart fa-lg" style="color: #198754;"></i>
                                    <span id="users-civil-status"></span>
                                </label>
                                <button type="button" id="civilEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editCivilStatusModal">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label" for="email">
                                    <i class="fa-solid fa-envelope fa-lg" style="color: #198754;"></i>
                                    <span id="users-email"></span>
                                </label>
                                <button type="button" id="emailEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editEmailModal">
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
                                <button type="button" id="editAccountEmailBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editAccountEmailModal">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                            </div>

                            <!-- Password Settings -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" id="changePasswordBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fa-solid fa-key fa-lg"></i> Change Password
                                </button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Name -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Last Name -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editLastNameInput" placeholder="Last name">
                </div>
                
                <!-- First Name -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editFirstNameInput" placeholder="First name">
                </div>
                
                <!-- Middle Name -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editMiddleNameInput" placeholder="Middle name">
                </div>

                <!-- Suffix -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editSuffixInput" placeholder="Suffix (e.g., Jr., Sr.)">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Location -->
<div class="modal fade" id="editLocationModal" tabindex="-1" aria-labelledby="editLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLocationModalLabel">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="editLocationInput" placeholder="Enter new location">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Civil Status -->
<div class="modal fade" id="editCivilStatusModal" tabindex="-1" aria-labelledby="editCivilStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCivilStatusModalLabel">Edit Civil Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Dropdown for Civil Status -->
                <select class="form-select" id="editCivilStatusInput">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                </select>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Email -->
<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="email" class="form-control" id="editEmailInput" placeholder="Enter new email">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Account Email -->
<div class="modal fade" id="editAccountEmailModal" tabindex="-1" aria-labelledby="editAccountEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountEmailModalLabel">Edit Account Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="email" class="form-control" id="editAccountEmailInput" placeholder="Enter new account email">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
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
                        <input type="password" id="modalOldPassword" class="form-control" required>
                        <!-- Feedback positioned above the input field, to the right -->
                        <span id="oldPasswordFeedback" class="position-absolute"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalNewPassword" class="form-label">New Password</label>
                        <input type="password" id="modalNewPassword" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" id="modalConfirmPassword" class="form-control" required>
                        <span id="passwordFeedback" class="position-absolute text-danger"></span>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>