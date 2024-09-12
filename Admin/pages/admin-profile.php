<?php
    // Assuming you have a database connection setup and the admin's email is stored in the session
    include('../../dbconn.php'); // Adjust the path to your actual database connection file

    // Fetch the admin details from the database
    $email = $_SESSION['email'];
    $sql = "SELECT firstname, lastname, department, email, password, profile_picture FROM users_acc WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
    } else {
        // Handle the case where no admin is found
        $admin = [
            'firstname' => 'N/A',
            'lastname' => 'N/A',
            'department' => 'N/A',
            'email' => 'N/A',
            'password' => 'N/A',
            'profile_picture' => 'img/undraw_profile_1.svg'
        ];
    }

    $stmt->close();
    $conn->close();
?>

<div class="container-fluid">
    <!-- Admin Profile Card -->
    <div class="card shadow-sm border-light rounded">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Profile Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <!-- Drag and Drop Upload Area -->
                    <div class="upload-area" id="uploadArea">
                        <!-- Upload Icon -->
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <!-- Drag and Drop Text -->
                        <div class="text">Drag & Drop or Click to Upload</div>
                        <!-- Hidden File Input -->
                        <input type="file" id="fileInput" style="display: none;">
                    </div>
                    <!-- Upload Button -->
                    <div class="upload-btn">
                        <button class="btn btn-primary" id="uploadButton">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> Upload
                        </button>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Admin Info -->
                    <div class="mb-3">
                        <label class="form-label"><strong>First Name:</strong></label>
                        <p><?php echo htmlspecialchars($admin['firstname']); ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Last Name:</strong></label>
                        <p><?php echo htmlspecialchars($admin['lastname']); ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Department:</strong></label>
                        <p><?php echo htmlspecialchars($admin['department']); ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Email:</strong></label>
                        <p><?php echo htmlspecialchars($admin['email']); ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Password:</strong></label>
                        <p>******</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>