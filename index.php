<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIMS</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/css/landing-page/landing-header.css">
    <link rel="stylesheet" href="assets/css/landing-page/home-section.css">
    <link rel="stylesheet" href="assets/css/landing-page/dept-section.css">
    <link rel="stylesheet" href="assets/css/landing-page/team-section.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>

    <!-- INCLUDE LANDING HEADER -->
    <?php include('components/landing-header.php'); ?>

    <!-- HOME SECTION -->
    <section class="home-section" id="home">
        <div class="home-content">
            <h1 class="display-6 fw-bold">Welcome To AIMS!</h1>
            <p class="lead">Where you Achieve, Inspire, Motivate, & Succeed</p>
            <a href="#department" class="btn btn-success btn-sm">Tell Me More</a>
        </div>
        <img src="img/esyatek-bg1-logo.png" alt="Logo" class="home-logo">
    </section>

    <!-- DEPARTMENT SECTION -->
    <section class="dept-section" id="department">
        <div class="row">
            <div class="card-container col-12">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: skyblue;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/ba-card.jpg');"></div>
                        <div class="card-back" style="background-color: gold;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/hm-card.jpg');"></div>
                        <div class="card-back" style="background-color: lightgray;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/tm-card.jpg');"></div>
                        <div class="card-back" style="background-color: violet;"></div>
                    </div>
                </div>
                <div class="card active">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/ba-card.jpg');"></div>
                        <div class="card-back" style="background-color: pink;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/educ-card.jpg');"></div>
                        <div class="card-back" style="background-color: red;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/hm-card.jpg');"></div>
                        <div class="card-back" style="background-color: orange;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/a-card.jpg');"></div>
                        <div class="card-back" style="background-color: darkgray;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <div class="card-front" style="background-image: url('img/tm-card.jpg');"></div>
                        <div class="card-back" style="background-color: maroon;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COMPANY SECTION -->
    <section id="company">
        
    </section>

    <!-- ABOUT SECTION -->
    <section id="about">
        
    </section>

    <!-- TEAM SECTION -->
    <section class="team-section" id="team">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Team Member 1 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="img/bry.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>Bryan Custodio</h3>
                        <p class="text-muted">Back End Developer</p>
                        <div class="social-icons">
                            <a href="#" class="icon instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon gmail"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="img/al.heic" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>Albert Alias</h3>
                        <p class="text-muted">Full Stack Developer</p>
                        <div class="social-icons">
                            <a href="#" class="icon instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon gmail"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="team-member">
                        <img src="img/george.jpg" alt="" class="img-fluid rounded-circle">
                    </div>
                    <div class="text-center">
                        <h3>George Balauag</h3>
                        <p class="text-muted">UI Designer</p>
                        <div class="social-icons">
                            <div class="icon instagram"><i class="fa-brands fa-instagram"></i></div>
                            <div class="icon facebook"><i class="fa-brands fa-facebook-f"></i></div>
                            <div class="icon gmail"><i class="fa-regular fa-envelope"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!--START::LOGIN FUNCTION-->
    <script src="crud-ajax/login-users.js"></script>
    <!--END::LOGIN FUNCTION-->
    <script src="functions/landing-header.js"></script>
    <script src="functions/dept-card.js"></script>
</body>
</html>