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
                    <input class ="nameInput" type="text" name="name" placeholder="Your Name" required value="<?= $_SESSION['username'] ?? '' ?>">
                    <div class="alert-message-container">
                        <input class="emailInput" type="email" name="email" placeholder="Your Email" required value="<?= $_SESSION['email'] ?? ''?>">
                        <img class="sign-img-alert email-alert" src="../img/check-email-alert.png" alt="">
                    </div>
                    <select name="option" required>
                        <option hidden selected>Your role</option>
                        <option value="student">student</option>
                        <option value="teacher">teacher</option>
                    </select>
                    <div class="alert-message-container">
                        <input class="passwordInput" type="password" name="password" placeholder="Password" required value="<?= $_SESSION['password'] ?? ''?>">
                        <img class="sign-img-alert password-alert" src="../img/chek-password-alert.png" alt="">
                    </div>
                    <div class="alert-message-container">
                        <input class="passwordInput" type="password" name="confrimePassword" placeholder="Confrime Password" required value="<?= $_SESSION['confrimePassword'] ?? ''?>">
                        <img class="sign-img-alert password-alert" src="../img/chek-password-alert.png" alt="">
                    </div>
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
                            const emailAlert = document.querySelector(".email-alert")
                            emailInput.style.border = "1px solid red"
                            emailAlert.style.display = "block"
            </script>
    <?php   }
        unset($_SESSION['gmail_error']);
        if(isset($_SESSION['password_error'])){ ?>
            <script>
                            const passwordInput = document.querySelectorAll(".passwordInput")
                            const passwordAlert = document.querySelectorAll(".password-alert")
                            passwordInput.forEach(element => {
                                element.style.border = "1px solid red"
                            })

                            passwordAlert.forEach(element => {
                                element.style.display = "block"
                            })
            </script>   
    <?php   }
        unset($_SESSION['password_error']);
    ?>
</body>
</html>