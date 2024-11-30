<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/login.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background-image: url('../img/esyatek-campus.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>

    <!-- Login Container -->
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 col-lg-4 offset-md-3 offset-lg-4">
                <div class="login-box">
                    <!-- Logo -->
                    <img src="../img/esyatek-logo.png" alt="Esyatek Logo" class="logo img-fluid">

                    <!-- Login Form -->
                    <form id="loginForm">
                        <div class="form-control-wrapper">
                            <input type="text" class="form-control" id="username" placeholder=" " required>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-control-wrapper password-wrapper">
                            <input type="password" class="form-control" id="password" placeholder=" " required>
                            <label for="password">Password</label>
                            <svg class="show-password" id="showPassword" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404345">
                                <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                            </svg>
                            <svg class="hide-password" id="hidePassword" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#404345">
                                <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>
                            </svg>
                        </div>

                        <!-- Remember Me and Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                
                            </div>
                            <a href="#" class="text-decoration-none">Forgot Password?</a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-success w-100 custom-border">Log in</button>

                        <!-- No Account Link -->
                        <p class="no-account-text">Don't have an account? Ask your Department Coordinator</p>
                    </form>
                </div>
            </div>
            <!-- Go Back Container -->
            <div class="go-back-container">
                <a href="../index.php" class="go-back-link d-flex align-items-center">
                    <i class="fa-solid fa-right-to-bracket me-2 flipped-icon"></i> Go back
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/29c04b1733.js" crossorigin="anonymous"></script>
    
    <script src="../crud-ajax/login-users.js"></script>
    <script src="../functions/login.js"></script>
</body>
</html>