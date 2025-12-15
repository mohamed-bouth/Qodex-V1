<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <section class="login-container">
        <form class="login-container-left" method="POST" action="./try_register.php">
            <div class="logo-img-container">
                <img src="../img/qodex-logo.png" alt="">
            </div>
            <div class="login-container-content">
                <h1>You dont have a account ?</h1>
                <p>the best quiz platform waiting you !</p>
                <div class="input-container">
                    <label class="label"></label>
                    <input class ="nameInput" type="text" name="name" placeholder="Your Name" required>
                    <div></div>
                    <input class="emailInput" type="email" name="email" placeholder="Your Email" required>
                    <img src="../img/check-email-alert.png" alt="">
                    <select name="option" required>
                        <option value="" hidden selected>Your role</option>
                        <option value="student">student</option>
                        <option value="teacher">teacher</option>
                    </select>
                    <input class="passwordInput" type="password" name="password" placeholder="Password" required>
                    <input class="passwordInput" type="password" name="confrimePassword" placeholder="Confrime Password" required>
                </div>
                <div class="login-container-btn">
                    <button type="submit" name="create" class="create-btn">Create new account</button>
                    <a class="return-btn" href="./login.php">&#9166;</a>
                </div>
            </div>
            <div class="logo-img-container"></div>
        </form>
        <div class="login-container-right">
            <img src="../img/sign-img-sign-page.png" alt="">
        </div>
    </section>
    <?php
        if (isset($_SESSION['gmail_error'])) { ?>
            <script>  
                            const emailInput = document.querySelector(".emailInput")
                            emailInput.style.border = "1px solid red"
            </script>
    <?php   }
        if(isset($_SESSION['password_error'])){ ?>
            <script>
                            const passwordInput = document.querySelector(".passwordInput")
                            passwordInput.style.border = "1px solid red"
            </script>   
    <?php   }
        unset($_SESSION['password_error']);
    ?>
</body>
</html>