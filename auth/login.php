<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <section class="login-container">
        <form class="login-container-left" method="POST" action="./try_login.php">
            <div class="logo-img-container">
                <img src="../img/qodex-logo.png" alt="">
            </div>
            <div class="login-container-content">
                <h1>Welcome Back</h1>
                <p>Welcome back to your quiz Platform</p>
                <div class="input-container">
                    <label class="label"></label>
                    <input class="emailInput" type="email" name="email" placeholder="Email" required>
                    <input class="passwordInput" type="password" name="password" placeholder="Password" required>
                    <a href="">forggeten password</a>
                </div>
                <div class="login-container-btn">
                    <button type="submit" name="login" class="login-btn">Login</button>
                    <a href="./register.php" class="sign-btn">Sign up</a>
                </div>
            </div>
            <div class="logo-img-container"></div>
        </form>
        <div class="login-container-right">
            <img src="../img/lock-img-login-page.png" alt="">
        </div>
    </section>
    <?php
        if (isset($_SESSION['signin_error'])) { ?>
            <script>  
                            const emailInput = document.querySelector(".emailInput")
                            const passwordInput = document.querySelector(".passwordInput")
                            const label = document.querySelector(".label")
                            emailInput.style.border = "1px solid red"
                            passwordInput.style.border = "1px solid red"
                            label.textContent = "check your email and password"
                            label.style.color = "red"
                </script>;
        <?php    
        unset($_SESSION['signin_error']);
        }
    ?>
</body>
</html>