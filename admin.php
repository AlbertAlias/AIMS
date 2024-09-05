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

    <title>SB Admin 2 - Dashboard</title>
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/style.css">
    <!-- <link rel="stylesheet" href="assets/datatable.css"> -->
    <link rel="stylesheet" href="assets/ownTable.css">
    <link rel="stylesheet" href="assets/admin-profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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

        <!-- Sidebar Content -->
        <?php include('components/admin-sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!--Header Content -->
            <?php include('components/admin-header.php'); ?>

            <!-- Main Content -->
            <div class="" id="content">

                <!-- Begin Page Content -->

                <!-- Pages Content -->
                <div id="page-content">
                    <?php include($page); ?>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-6 mb-4"></div>
                </div>

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JQUERY CDN Link -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" defer></script>
    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <!--START:FONT AWESOME ICON LINK-->
    <script src="https://kit.fontawesome.com/29c04b1733.js" defer crossorigin="anonymous"></script>
    <!--END:FONT AWESOME ICON LINK-->
    
    <!-- DataTables CDN Link -->
    <!-- <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script> -->
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js" defer></script>
    <!-- <script src="js/sb-admin-2.js"></script> -->

    <!--START::FUNCTIONS-->
    <script src="functions/add-users/email.js" defer></script>
    <script src="functions/add-users/studForm-display.js" defer></script>
    <script src="functions/add-users/studID.js" defer></script>
    <script src="functions/add-users/user-type.js" defer></script>
    <script src="functions/admin-profile/drag_drop.js" defer></script>
    <!--END::FUNCTION-->

    <!--START::CRUD AJAX FUNCTIONS-->
    <script src="crud-ajax/manage-users/create-users.js" defer></script>
    <script src="crud-ajax/manage-users/ownTable.js" defer></script>
    <script src="crud-ajax/admin-profile/create_profile.js" defer></script>
    <!-- <script src="crud-ajax/manage-users/retrieve-users.js"></script> -->
    <!--END::CRUD AJAX FUNCTIONS-->

    <script>
        function loadPage(page) {
            window.location.href = 'admin.php?page=' + page;
        }
        // function loadContent(type) {
        //     $.ajax({
        //         url: 'pages/' + type + '.php',
        //         method: 'GET',
        //         success: function (response) {
        //             $('#page-content').html(response);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error loading content:', error);
        //             $('#page-content').html('<p>Content could not be loaded.</p>');
        //         }
        //     });
        // }

        function toggleActive(element) {
            // Remove 'active' class from all sidebar items
            $('.nav-item').removeClass('active');
            // Add 'active' class to the clicked item
            $(element).closest('.nav-item').addClass('active');
        }
    </script>
</body>
</html>