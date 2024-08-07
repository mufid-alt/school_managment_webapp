<?php
    session_start();
    include("../backend/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/index.css">
    
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <title>Login</title>
    </head>
    <body>
        <!-- Div to show error message -->
        <div class="error"></div>

        <div class="login">
            <div class="login__content">
                <div class="login__img">
                    <img src="./img/img-login.svg" alt="Login SVG">
                </div>

                <div class="login__forms">
                    <form action="./index.php" method="post" class="login__registre" id="login-in">
                        <h1 class="login__title">User Sign In</h1>
    
                        <div class="login__box">
                            <i class='bx bx-at login__icon'></i>
                            <input type="email" placeholder="Email" class="login__input" name="user-email">
                        </div>
    
                        <div class="login__box">
                            <i class='bx bx-lock-alt login__icon'></i>
                            <input type="password" placeholder="Password" class="login__input" name="user-password">
                        </div>

                        <div class="staff__login">
                            <input type="checkbox" name="teacher-login" id="staff-login"><label class="login__forgot" for="staff-login">Staff Login ?</label>
                        </div>

                        <button type="submit" class="login__button" name="user-login">Sign In</button>

                        <div>
                            <span class="login__account">Administrator Log In ?</span>
                            <span class="login__signin" id="sign-up">Log In</span>
                        </div>
                    </form>

                    <form action="./index.php" method="post" class="login__create none" id="login-up">
                        <h1 class="login__title">Admin Sign In</h1>
    
                        <div class="login__box">
                            <i class='bx bx-at login__icon'></i>
                            <input type="text" placeholder="Email" class="login__input" name="admin-email">
                        </div>

                        <div class="login__box">
                            <i class='bx bx-lock-alt login__icon'></i>
                            <input type="password" placeholder="Password" class="login__input" name="admin-pass">
                        </div>

                        <button type="submit" class="login__button" name="admin-login">Sign In</button>

                        <div>
                            <span class="login__account">User Sign In ?</span>
                            <span class="login__signup" id="sign-in">Log In</span>
                        </div>

                        <div class="login__social">
                            <a href="#" class="login__social-icon"><i class='bx bxl-facebook' ></i></a>
                            <a href="#" class="login__social-icon"><i class='bx bxl-twitter' ></i></a>
                            <a href="#" class="login__social-icon"><i class='bx bxl-google' ></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--===== MAIN JS =====-->
        <script src="./scripts/index.js"></script>
    </body>
</html>

<?php include("../backend/login.php");?>