<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
        exit();
    }
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
    
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/departments.css">
    <link rel="stylesheet" href="../assets/css/coordinators.css">
    <link rel="stylesheet" href="../assets/css/interns.css">
    <link rel="stylesheet" href="../assets/css/admin-profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        html, body {
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
            background-color: #f8f8f8;
        }

        #page-content {
            flex-grow: 1;
            padding: 10px;
        }
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
                    <?php include "pages/departments.php"; ?>
                    <?php include "pages/coordinators.php"; ?>
                    <?php include "pages/interns.php"; ?>
                    <?php include "pages/sub-admins.php"; ?>
                    <?php include "pages/admin-profile.php"; ?>
                </div>

                <!-- Content Row -->
                <!-- <div class="row">
                    <div class="col-lg-6 mb-4"></div>
                </div> -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>
    <script src="../js/sidebar.js"></script>

    <!--START::CRUD AJAX FUNCTIONS-->
    <script src="crud-ajax/dashboard/retrieve-users-analytics.js"></script>
    <script src="crud-ajax/dashboard/retrieve-deptCounts.js"></script>
    <script src="crud-ajax/dashboard/retrieve-coorCounts.js"></script>
    <script src="crud-ajax/dashboard/retrieve-internCounts.js"></script>
    <script src="crud-ajax/dashboard/retrieve-adminCounts.js"></script>

    <script src="functions/departments/dept-form-enable.js"></script>
    <script src="crud-ajax/departments/create-depts.js"></script>
    <script src="crud-ajax/departments/retrieve-depts.js"></script>
    <script src="crud-ajax/departments/update-depts.js"></script>
    <script src="crud-ajax/departments/delete-depts.js"></script>

    <script src="crud-ajax/coordinators/retrieve-coor-deptsName.js"></script>
    <script src="functions/coordinators/coor-form-enable.js"></script>
    <script src="crud-ajax/coordinators/retrieve-coor.js"></script>
    <script src="crud-ajax/coordinators/retrieve-coor-info.js"></script>
    <script src="crud-ajax/coordinators/create-coor.js"></script>
    <script src="functions/coordinators/coor-email.js"></script>
    <script src="functions/coordinators/contact-number.js"></script>
    <script src="crud-ajax/coordinators/update-coor.js"></script>
    <script src="crud-ajax/coordinators/delete-coor.js"></script>

    <script src="crud-ajax/interns/retrieve-interns.js"></script>
    <script src="crud-ajax/interns/retrieve-intern-deptsName.js"></script>
    <script src="functions/interns/intern-form-enable.js"></script>
    <script src="crud-ajax/interns/retrieve-intern-info.js"></script>
    <script src="crud-ajax/interns/create-interns.js"></script>
    <script src="functions/interns/intern-email.js"></script>
    <script src="functions/interns/studID.js"></script>
    <script src="functions/interns/internPass.js"></script>
    <script src="crud-ajax/interns/update-interns.js"></script>

    <script src="crud-ajax/admins/create-admins.js"></script>
    <script src="crud-ajax/admins/retrieve-admin-details.js"></script>
    <script src="crud-ajax/admins/retrieve-admins.js"></script>
    <script src="functions/admins/admin-form-enable.js"></script>
    <script src="functions/admins/intern-email.js"></script>
    <script src="crud-ajax/admins/update-admins.js"></script>

    <script src="crud-ajax/profile/retrieve-profile.js"></script>
    <script src="crud-ajax/profile/create-profile.js"></script>
    <script src="crud-ajax/profile/retrieve-admins-initials.js"></script>
    <script src="crud-ajax/profile/retrieve-admin-users.js"></script>
    <!--END::CRUD AJAX FUNCTIONS-->
</body>
</html>