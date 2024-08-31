<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 'pages/admin-dashboard.php'; // Set default page
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

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar Content -->
        <?php include('components/admin-sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Headernav Content -->
            <?php include('components/headernav.php'); // Default content ?>

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->

                <!-- Pages Content -->
                <div id="page-content">
                    <?php include('pages/' . $page); ?>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-6 mb-4"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- jQuery CDN Link -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!--START:FONT AWESOME ICON LINK-->
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>
    <!--END:FONT AWESOME ICON LINK-->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var collapseToggle = document.querySelectorAll('[data-bs-toggle="collapse"]');

            collapseToggle.forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    var icon = this.querySelector('.fas.fa-chevron-right');
                    if (this.classList.contains('collapsed')) {
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        icon.style.transform = 'rotate(90deg)';
                    }
                });
            });
        });

        function loadPage(page) {
            window.location.href = 'admin.php?page=' + page;
        }
    </script>
</body>
</html>