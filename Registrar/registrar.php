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

    <!--START::CORE CSS-->
    <link rel="stylesheet" href="../assets/style/core-css/main.css">
    <link rel="stylesheet" href="../assets/style/core-css/sidebar.css">
    <link rel="stylesheet" href="../assets/style/core-css/header.css">
    <link rel="stylesheet" href="../assets/style/core-css/profile.css">
    <link rel="stylesheet" href="../assets/js/apexcharts.js-4.3.0/dist/apexcharts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <!--END::CORE CSS-->

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!--START::REGISTRAR CSS-->
    <link rel="stylesheet" href="../assets/style/registrar/tablestyles.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        #wrapper {
            display: flex;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        #content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #f8f8f8;
        }

        #content {
            padding: 1rem;
            flex-grow: 1;
        }

        #page-content {
            flex-grow: 1;
            padding: 10px;
        }
    </style>
    <!--END::REGISTRAR CSS-->
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include('components/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <?php include('components/header.php'); ?>

            <div id="content">

                <div id="page-content" style="width: 100%;">
                    <?php include "pages/studentlist.php"; ?>
                    <?php include "pages/coordinatorlist.php"; ?>
                    <?php include "pages/supervisorlist.php"; ?>
                    <?php include "pages/deanlist.php"; ?>
                    <?php include "pages/profile.php"; ?>
                </div>
            </div>
        </div>
    </div>

    <!--START::CORE SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../assets/js/apexcharts.js-4.3.0/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <!-- <script src="functions/auto-logout/session-timeout.js"></script> -->
    <!--END::CORE SCRIPTS-->

    <!--START::CRUD AJAX FUNCTIONS-->

    <!--END::CRUD AJAX FUNCTIONS-->

    <!--START::PROFILE FUNCTION-->
    <script src="crud-ajax/profile/retrieve-users-profile.js"></script>
    <script src="crud-ajax/profile/create-users-profile.js"></script>
    <script src="crud-ajax/profile/retrieve-users-info.js"></script>
    <script src="crud-ajax/profile/update-users-info.js"></script>
    <script src="functions/profile/profile-details.js"></script>
    <!--END::PROFILE FUNCTION-->

    <!-- student start-->
    <script src="crud-ajax/student/retrieve-stud-ojthours.js"></script>
    <script src="crud-ajax/student/retrieve-stud-lists.js"></script>
    <!-- student end -->

    <!-- coordinator start -->
    <script src="crud-ajax/coordinator/retrieve-coor-lists.js"></script>
    <!-- coordinator end -->

    <!-- supervisor start -->
    <script src="crud-ajax/supervisor/retrieve-supervisor-lists.js"></script>
    <!-- supervisor end -->

    <!-- dean start -->
    <script src="crud-ajax/dean/retrieve-dean-lists.js"></script>
    <!-- deab end -->
</body>

</html>