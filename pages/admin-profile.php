<?php
session_start();
require_once '../dbconn.php';

// Assuming the admin's email is stored in the session
$email = $_SESSION['email'];

// Query to fetch admin details
$query = "SELECT firstname, lastname, department, email, password, user_type FROM users_acc WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Check if user is an admin and also an OJT Coordinator
$departments_handled = [];
if ($user['user_type'] == 'Admin' && isset($user['department'])) {
    // Example query to get departments handled by admin if they are also an OJT Coordinator
    $departments_query = "SELECT department_name FROM departments WHERE coordinator_email = '$email'";
    $departments_result = mysqli_query($conn, $departments_query);
    while ($row = mysqli_fetch_assoc($departments_result)) {
        $departments_handled[] = $row['department_name'];
    }
}
?>

<div class="container">
    <h2>Profile Information</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" value="<?php echo $user['firstname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" value="<?php echo $user['lastname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="userType">User Type:</label>
                <input type="text" class="form-control" id="userType" value="<?php echo $user['user_type']; ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="departments">Departments Handled:</label>
                <select class="form-control" id="departments">
                    <?php foreach ($departments_handled as $department) : ?>
                        <option><?php echo $department; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>