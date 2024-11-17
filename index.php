<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIMS</title>

    <!-- STYLES -->
    <!-- <link rel="stylesheet" href="assets/css/landing.css"> -->
    <link rel="stylesheet" href="assets/css/landing-header.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            background-image: url('img/esyatek-bg1.jpeg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed; /* Optional: this makes the background stay fixed while scrolling */
            min-height: 100vh; /* Ensure the background covers the entire viewport */
        }
    </style>
</head>
<body>

    <!-- INCLUDE LANDING HEADER -->
    <?php include('components/landing-header.php'); ?>

    <!-- START CONTAINER -->
    <div class="container mt-5 pt-5"> <!-- mt-5 pt-5 adds space to prevent content from being hidden under navbar -->
        <!-- Your page content goes here -->
        <h1>Welcome to AIMS</h1>
        <p>Your landing page content goes here. This container will be responsive across all screen sizes.</p>
    </div>
    <!-- END CONTAINER -->

    <!-- JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>

    <!--START::LOGIN FUNCTION-->
    <script src="crud-ajax/login-users.js"></script>
    <!--END::LOGIN FUNCTION-->
    <script src="functions/landing.js" ></script>

</body>
</html>