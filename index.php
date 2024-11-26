<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIMS</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="assets/css/landing-home.css">
    <link rel="stylesheet" href="assets/css/landing-dept.css">
    <link rel="stylesheet" href="assets/css/landing-header.css">

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        <div class="container">
            <div class="row">
                <!-- Left Container with 9 Circle Buttons -->
                <div class="col-md-6">
                    <div class="left-container">
                        <div class="row mb-5">
                            <!-- Row 1 -->
                            <div class="col-4">
                                <button class="circle-btn active">
                                    <img src="img/esyatek-a-logo.png" alt="Logo">
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-ba-logo.png" alt="Logo">
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-cpe-logo.png" alt="Logo">
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Row 2 -->
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-cs-logo.png" alt="Logo">
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-crim-logo.png" alt="Logo">
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-educ-logo.png" alt="Logo">
                                </button>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <!-- Row 3 -->
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-hm-logo.png" alt="Logo">
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-it-logo.png" alt="Logo">
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="circle-btn">
                                    <img src="img/esyatek-tm-logo.png" alt="Logo">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Container with Vertical Rectangle Button -->
                <div class="col-md-6">
                    <div class="right-container">
                        <!-- Card Containers -->
                        <div class="card-container active" id="card-1">
                            <div class="front">Content for Card 1</div>
                            <div class="back">Back of Card 1</div>
                        </div>
                        <div class="card-container" id="card-2">
                            <div class="front">Content for Card 2</div>
                            <div class="back">Back of Card 2</div>
                        </div>
                        <div class="card-container" id="card-3">
                            <div class="front">Content for Card 3</div>
                            <div class="back">Back of Card 3</div>
                        </div>
                        <div class="card-container" id="card-4">
                            <div class="front">Content for Card 4</div>
                            <div class="back">Back of Card 4</div>
                        </div>
                        <div class="card-container" id="card-5">
                            <div class="front">Content for Card 5</div>
                            <div class="back">Back of Card 5</div>
                        </div>
                        <div class="card-container" id="card-6">
                            <div class="front">Content for Card 6</div>
                            <div class="back">Back of Card 6</div>
                        </div>
                        <div class="card-container" id="card-7">
                            <div class="front">Content for Card 7</div>
                            <div class="back">Back of Card 7</div>
                        </div>
                        <div class="card-container" id="card-8">
                            <div class="front">Content for Card 8</div>
                            <div class="back">Back of Card 8</div>
                        </div>
                        <div class="card-container" id="card-9">
                            <div class="front">Content for Card 9</div>
                            <div class="back">Back of Card 9</div>
                        </div>
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

    <!-- CONTACT SECTION -->
    <section id="contact">
        
    </section>

    <!-- JS SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>

    <!--START::LOGIN FUNCTION-->
    <script src="crud-ajax/login-users.js"></script>
    <!--END::LOGIN FUNCTION-->
    <script src="functions/landing-header.js"></script>
    <script src="functions/dept-card.js"></script>
</body>
</html>