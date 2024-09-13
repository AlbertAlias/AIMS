<?php
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'OJT Student') {
    header('Location: login.php');
    exit();
}

// Check if department is set in session
if (!isset($_SESSION['department'])) {
    echo 'Department is not set.';
    exit();
}

$department = $_SESSION['department'];

// Map session department values to folder names
switch ($department) {
    case 'Information Technology':
        $folder = 'IT';
        $dashboard_page = 'it-dashboard.php';
        break;
    case 'Computer Science':
        $folder = 'CS';
        $dashboard_page = 'cs-dashboard.php';
        break;
    case 'Computer Engineering':
        $folder = 'CpE';
        $dashboard_page = 'cpe-dashboard.php';
        break;
    case 'Tourism Management':
        $folder = 'TM';
        $dashboard_page = 'tm-dashboard.php';
        break;
    case 'Hospitality Management':
        $folder = 'HM';
        $dashboard_page = 'hm-dashboard.php';
        break;
    case 'Business Administration':
        $folder = 'BA';
        $dashboard_page = 'ba-dashboard.php';
        break;
    case 'Accountancy':
        $folder = 'A';
        $dashboard_page = 'a-dashboard.php';
        break;
    case 'Education':
        $folder = 'EDUC';
        $dashboard_page = 'educ-dashboard.php';
        break;
    case 'Criminology':
        $folder = 'CRIM';
        $dashboard_page = 'crim-dashboard.php';
        break;
    default:
        echo 'Invalid department';
        exit();
}

// Set the page based on GET request or default to the department's dashboard
$page = isset($_GET['page']) ? $_GET['page'] : $dashboard_page;
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    // Include the sidebar based on the department
    switch ($folder) {
        case 'IT':
            include('IT/components/it-sidebar.php');
            break;
        case 'CS':
            include('CS/components/cs-sidebar.php');
            break;
        case 'CpE':
            include('CpE/components/cpe-sidebar.php');
            break;
        case 'TM':
            include('TM/components/tm-sidebar.php');
            break;
        case 'HM':
            include('HM/components/hm-sidebar.php');
            break;
        case 'BA':
            include('BA/components/ba-sidebar.php');
            break;
        case 'A':
            include('A/components/a-sidebar.php');
            break;
        case 'EDUC':
            include('EDUC/components/educ-sidebar.php');
            break;
        case 'CRIM':
            include('CRIM/components/crim-sidebar.php');
            break;
        default:
            echo 'Invalid department';
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
        <div id="content">

            <!-- Begin Page Content -->
            <div id="page-content" style="width: 100%;">
                <?php
                // Map the department folder to page path
                $pagePath = "{$folder}/pages/{$page}";
                
                // Check if the file exists before including
                if (file_exists($pagePath)) {
                    include($pagePath);
                } else {
                    echo 'Page not found in: ' . $pagePath;
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