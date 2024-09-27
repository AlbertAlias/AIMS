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
    
    <!-- Custom styles for this template-->
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- STYLES -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/departments.css">
    <link rel="stylesheet" href="../assets/css/coordinators.css">
    <link rel="stylesheet" href="../assets/css/admin-profile.css">
    <link rel="stylesheet" href="../assets/css/manage-users.css">
    <!-- <link rel="stylesheet" href="assets/css/datatable.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/ownTable.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        #wrapper {
            height: 100%;
        }

        #content-wrapper {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        #content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 1rem;
        }

        #page-content {
            flex-grow: 1;
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JQUERY CDN Link -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" defer></script>
    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <!--START:FONT AWESOME ICON LINK-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" defer crossorigin="anonymous"></script>
    <!--END:FONT AWESOME ICON LINK-->

    
    <!-- DataTables CDN Link -->
    <!-- <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script> -->
    <!-- Custom scripts for all pages-->
    <script src="../js/sidebar.js" defer></script>
    <!-- <script src="js/sb-admin-2.js"></script> -->

    <!--START::FUNCTIONS-->
        <script src="functions/departments/form-enable.js" defer></script>

        <script src="functions/coordinators/form-enable.js" defer></script>
        <script src="functions/coordinators/coor-email.js" defer></script>
        <script src="functions/coordinators/contact-number.js" defer></script>

        <script src="functions/interns/form-enable.js" defer></script>
        <script src="functions/interns/intern-email.js" defer></script>
        <script src="functions/interns/studID.js" defer></script>
        <script src="functions/interns/internPass.js" defer></script>

        <script src="functions/admins/form-enable.js" defer></script>
        <script src="functions/admins/intern-email.js" defer></script>

        <!-- <script src="functions/admin-profile/drag_drop.js" defer></script> -->
    <!--END::FUNCTIONS-->

    <!--START::CRUD AJAX FUNCTIONS-->
        <script src="crud-ajax/dashboard/retrieve-deptCounts.js" defer></script>
        <script src="crud-ajax/dashboard/retrieve-coorCounts.js" defer></script>
        <script src="crud-ajax/dashboard/retrieve-internCounts.js" defer></script>
        <script src="crud-ajax/dashboard/retrieve-adminCounts.js" defer></script>

        <script src="crud-ajax/departments/create-depts.js" defer></script>
        <script src="crud-ajax/departments/retrieve-depts.js" defer></script>
        <script src="crud-ajax/departments/update-depts.js" defer></script>
        <script src="crud-ajax/departments/delete-depts.js" defer></script>

        <script src="crud-ajax/coordinators/create-coor.js" defer></script>
        <script src="crud-ajax/coordinators/retrieve-coor.js" defer></script>
        <script src="crud-ajax/coordinators/retrieve-deptsName.js" defer></script>
        <script src="crud-ajax/coordinators/update-coor.js" defer></script>
        <script src="crud-ajax/coordinators/delete-coor.js" defer></script>

        <script src="crud-ajax/interns/create-interns.js" defer></script>
        <script src="crud-ajax/interns/retrieve-deptsName.js" defer></script>
        <script src="crud-ajax/interns/retrieve-interns.js" defer></script>
        <script src="crud-ajax/interns/update-interns.js" defer></script>

        <script src="crud-ajax/admins/create-admins.js" defer></script>
        <script src="crud-ajax/admins/retrieve-admin-details.js" defer></script>
        <script src="crud-ajax/admins/update-admins.js" defer></script>
    <!--END::CRUD AJAX FUNCTIONS-->
</body>
</html>