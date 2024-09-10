<?php
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'OJT Student') {
    // Redirect to login if not a student
    header('Location: login.php');
    exit();
}

// Check if department is set in session
if (!isset($_SESSION['department'])) {
    echo 'Department is not set.';
    exit();
}

$department = $_SESSION['department'];
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar-->
    <?php
    // Include the sidebar based on the department
    switch ($department) {
        case 'Information Technology':
            include('IT/components/it-sidebar.php');
            break;
        case 'Computer Science':
            include('CS/components/cs-sidebar.php');
            break;
        case 'Computer Engineering':
            include('CpE/components/cpe-sidebar.php');
            break;
        case 'Tourism Management':
            include('TM/components/tm-sidebar.php');
            break;
        case 'Hospitality Management':
            include('HM/components/hm-sidebar.php');
            break;
        case 'Business Administration':
            include('BA/components/ba-sidebar.php');
            break;
        case 'Accountancy':
            include('A/components/a-sidebar.php');
            break;
        case 'Education':
            include('EDUC/components/educ-sidebar.php');
            break;
        case 'Criminology':
            include('CRIM/components/crim-sidebar.php');
            break;
        default:
            echo 'Invalid department';
            break;
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

    <title>Student</title>
    
    <!-- Custom styles for this template-->
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- STYLES -->

    <!-- <link rel="stylesheet" href="assets/css/datatable.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/ownTable.css"> -->
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

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Header Content -->
        <?php 
        // Check if the student-header.php file exists
        $header_file = 'components/student-header.php';
        if (file_exists($header_file)) {
            include($header_file);
        } else {
            echo 'Header file not found.';
        }
        ?>

        <!-- Main Content -->
        <div class="" id="content">

            <!-- Begin Page Content -->
            <div id="page-content" style="width: 100%;">
                <?php
                // Ensure $page is set before including
                if (isset($page) && file_exists($page)) {
                    include($page);
                } else {
                    echo '';
                }
                ?>
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

    <!--START::FUNCTIONS-->

    <!--END::FUNCTION-->

    <!--START::CRUD AJAX FUNCTIONS-->

    <!--END::CRUD AJAX FUNCTIONS-->

    <script>
        function loadPage(page) {
            window.location.href = 'student.php?page=' + page;
        }
    </script>
</body>
</html>