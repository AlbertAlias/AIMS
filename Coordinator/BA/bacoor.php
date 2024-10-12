<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../../index.php'); // Adjust path if needed
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

    <title>Business Administration</title>
    
    <link href="../../assets/css/main.css" rel="stylesheet">
    <link href="../../assets/css/sidebar.css" rel="stylesheet">

    <link href="../../assets/intern-css/BA-css/dashboard.css" rel="stylesheet">
    <link href="../../assets/intern-css/BA-css/requirements.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
        <?php include('components/ba-sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Header Content -->
            <?php include('components/ba-header.php'); ?>

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div id="page-content" style="width: 100%;">
                    <?php include "pages/dashboard.php"; ?>
                    <?php include "pages/weekly-reports.php"; ?>
                    <?php include "pages/requirements.php"; ?>
                </div>

                <!-- Content Row -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <script src="https://code.jquery.com/jquery-3.7.1.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" defer crossorigin="anonymous"></script>
    <script src="../../js/sidebar.js" defer></script>

    <script src="crud-ajax/weekly-reports/create-reports"></script>

    <script src="crud-ajax/requirements/create-requirements.js"></script>
</body>
</html>