<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
        exit();
    }

    // Set default page path correctly
    $page = isset($_GET['page']) ? $_GET['page'] : 'pages/admin-dashboard.php';

    // Sanitize and validate the page parameter to prevent security issues
    $allowed_pages = [
        'pages/admin-dashboard.php',
        'pages/add-users.php',
        'pages/manage-users.php',
        'pages/departments.php',
        'pages/coordinators.php',
        'pages/admin-profile.php',
    ]; // Add more pages as needed
    if (!in_array($page, $allowed_pages)) {
        $page = 'pages/admin-dashboard.php'; // Default page
    }

    // Pass the current page to sidebar
    $current_page = $page;
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
    <link rel="stylesheet" href="../assets/css/admin-profile.css">
    <link rel="stylesheet" href="../assets/css/manage-users.css">
    <link rel="stylesheet" href="../assets/css/departments.css">
    <link rel="stylesheet" href="../assets/css/coordinators.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
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
        <?php include('components/admin-sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!--Header Content -->
            <?php include('components/admin-header.php'); ?>

            <!-- Main Content -->
            <div class="" id="content">

                <!-- Begin Page Content -->
                <div id="page-content" style="width: 100%;">
                    <?php include($page); ?>
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
    <!-- <script src="functions/add-users/email.js" defer></script>
    <script src="functions/add-users/studForm-display.js" defer></script>
    <script src="functions/add-users/studID.js" defer></script>
    <script src="functions/add-users/user-type.js" defer></script>
    <script src="functions/manage-users/table-actions.js" defer></script>
    <script src="functions/manage-users/edit-email.js" defer></script>
    <script src="functions/manage-users/edit-studID.js" defer></script>
    <script src="functions/add-depts/add-deptDisplay.js" defer></script>
    <script src="functions/add-coor/add-coorDisplay.js" defer></script>
    <script src="functions/add-coor/coor-email.js" defer></script>
    <script src="functions/add-coor/contact-number.js" defer></script>
    <script src="functions/admin-profile/drag_drop.js" defer></script> -->
    <!--END::FUNCTION-->

    <!--START::CRUD AJAX FUNCTIONS-->
    <!-- <script src="crud-ajax/add-users/create-users.js" defer></script>
    <script src="crud-ajax/manage-users/retrieve-tableData.js" defer></script>
    <script src="crud-ajax/manage-users/update-users.js" defer></script> -->
    <!-- <script src="crud-ajax/departments/add-depts.js" defer></script> -->
    <!-- <script src="crud-ajax/departments/create-depts.js" defer></script>
    <script src="crud-ajax/departments/retrieve-depts.js" defer></script>
    <script src="crud-ajax/departments/update-depts.js" defer></script>
    <script src="crud-ajax/departments/delete-depts.js" defer></script>
    <script src="crud-ajax/coordinators/create-coor.js" defer></script>
    <script src="crud-ajax/coordinators/retrieve-coor.js" defer></script>
    <script src="crud-ajax/coordinators/retrieve-deptsName.js" defer></script>
    <script src="crud-ajax/coordinators/update-coor.js" defer></script>
    <script src="crud-ajax/admin-profile/create_profile.js" defer></script> -->
    <!--END::CRUD AJAX FUNCTIONS-->

    <!--START::FUNCTIONS-->
    <?php if (strpos($page, 'add-users') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="functions/add-users/email.js" defer></script>
        <script src="functions/add-users/studForm-display.js" defer></script>
        <script src="functions/add-users/studID.js" defer></script>
        <script src="functions/add-users/user-type.js" defer></script>
        <script src="functions/manage-users/table-actions.js" defer></script>
        <script src="functions/manage-users/edit-email.js" defer></script>
        <script src="functions/manage-users/edit-studID.js" defer></script>
    <?php endif; ?>

    <?php if (strpos($page, 'departments') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="functions/add-depts/add-deptDisplay.js" defer></script>
    <?php endif; ?>

    <?php if (strpos($page, 'coordinators') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="functions/add-coor/add-coorDisplay.js" defer></script>
        <script src="functions/add-coor/coor-email.js" defer></script>
        <script src="functions/add-coor/contact-number.js" defer></script>
    <?php endif; ?>

    <?php if (strpos($page, 'admin-profile') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="functions/admin-profile/drag_drop.js" defer></script>
    <?php endif; ?>
    <!--END::FUNCTIONS-->

    <!--START::CRUD AJAX FUNCTIONS-->
    <?php if (strpos($page, 'add-users') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="crud-ajax/add-users/create-users.js" defer></script>
        <script src="crud-ajax/manage-users/retrieve-tableData.js" defer></script>
        <script src="crud-ajax/manage-users/update-users.js" defer></script>
    <?php endif; ?>

    <?php if (strpos($page, 'departments') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="crud-ajax/departments/create-depts.js" defer></script>
        <script src="crud-ajax/departments/retrieve-depts.js" defer></script>
        <script src="crud-ajax/departments/update-depts.js" defer></script>
        <script src="crud-ajax/departments/delete-depts.js" defer></script>
    <?php endif; ?>

    <?php if (strpos($page, 'coordinators') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="crud-ajax/coordinators/create-coor.js" defer></script>
        <script src="crud-ajax/coordinators/retrieve-coor.js" defer></script>
        <script src="crud-ajax/coordinators/retrieve-deptsName.js" defer></script>
        <script src="crud-ajax/coordinators/update-coor.js" defer></script>
    <?php endif; ?>

    <?php if (strpos($page, 'admin-profile') !== false || $page === 'pages/admin-dashboard.php'): ?>
        <script src="crud-ajax/admin-profile/create_profile.js" defer></script>
    <?php endif; ?>
    <!--END::CRUD AJAX FUNCTIONS-->

    <script>
        function loadPage(page) {
            window.location.href = 'admin.php?page=' + page;
        }
    </script>
</body>
</html>