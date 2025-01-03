<?php
    session_start();

    // Check if the user is logged in, if not, redirect to login page
    if (!isset($_SESSION['user_type'])) {
        header('Location: ../index.php');
        exit();
    }
    // Prevent caching
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>
    
    <link rel="stylesheet" href="../assets/style/core-css/main.css">
    <link rel="stylesheet" href="../assets/style/core-css/sidebar.css">
    <link rel="stylesheet" href="../assets/style/core-css/header.css">
    <link rel="stylesheet" href="../assets/style/core-css/profile.css">
    <link rel="stylesheet" href="../assets/js/apexcharts.js-4.3.0/dist/apexcharts.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../assets/style/student/dashboard.css">
    <link rel="stylesheet" href="../assets/style/student/requirement.css">
    <link rel="stylesheet" href="../assets/style/student/weeklyreport.css">
    <link rel="stylesheet" href="../assets/style/student/hours.css">
    <!-- <link rel="stylesheet" href="../assets/style/student/viewmodal.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

    <style>
        html, body { height: 100%; margin: 0; }
        #wrapper { display: flex; height: 100vh; margin: 0; padding: 0; }
        #content-wrapper { flex-grow: 1; display: flex; flex-direction: column; background-color: #f8f8f8; }
        #content { padding: 1rem; flex-grow: 1; }
        #page-content { flex-grow: 1; padding: 10px; }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar-->
        <?php include('components/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!--Header Content -->
            <?php include('components/header.php'); ?>

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div id="page-content" style="width: 100%;">
                    <?php include "pages/dashboard.php"; ?>
                    <?php include "pages/requirement.php"; ?>
                    <?php include "pages/weekly-report.php"; ?>
                    <?php include "pages/hours.php"; ?>
                    <?php include "pages/requirements-folder.php"; ?>
                    <?php include "pages/profile.php"; ?>
                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/apexcharts.js-4.3.0/dist/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <!-- <script src="functions/auto-logout/session-timeout.js"></script> -->

    <!--START::CRUD AJAX FUNCTIONS-->
    <script src="crud-ajax/profile/retrieve-users-profile.js"></script>
    <script src="crud-ajax/profile/create-users-profile.js"></script>
    <script src="crud-ajax/profile/retrieve-users-info.js"></script>
    <script src="crud-ajax/profile/update-users-info.js"></script>
    <script src="function/profile/profile-details.js"></script>

    <script src="crud-ajax/requirement/retrieve-requirements.js"></script>
    <script src="crud-ajax/requirement/retrieve-submit-file.js"></script>
    <script src="crud-ajax/weeklyreport/create-submit-weeklyreport.js"></script>
    <script src="crud-ajax/weeklyreport/retrieve-weekly-report.js"></script>
    <script src="crud-ajax/requirement/create-submit-file.js"></script>

    <script src="crud-ajax/hours/hours.js"></script>
    <script src="crud-ajax/hours/submit_hours.js"></script>
    <script src="crud-ajax/hours/retrieve_hours.js"></script>
    <!--END::CRUD AJAX FUNCTIONS-->
</body>
</html>