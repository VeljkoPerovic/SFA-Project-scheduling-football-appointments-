<?php
include_once '../model/process_signin.php';
include_once '../model/process_signup.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../styles/loginStyle.css">
    <title></title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" id="signup-form">
                <h1>Sign Up</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ili se registruj pomocu svog email-a</span>
                <?php
                if (!empty($error_message)) {
                    echo '<p class="error-message">' . $error_message . '</p>';
                } elseif (!empty($success_message)) {
                    echo '<p class="success-message">' . $success_message . '</p>';
                }
                ?>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" id="signin-form">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ili koristi svoj password email</span>
                <?php
                if (!empty($error_message_signin)) {
                    echo '<p class="error-message">' . $error_message_signin . '</p>';
                }
                ?>
                <?php
                if (!empty($error_message)) {
                    echo '<p class="error-message">' . $error_message . '</p>';
                } elseif (!empty($success_message)) {
                    echo '<p class="success-message">' . $success_message . '</p>';
                }
                ?>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Zaboravio/la si lozinku?</a>
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Dobrodosao nazad!</h1>
                    <p>Unesi svoje lične podatke i odmah zakažite Vaš prvi termin</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Pozdrav, Prijatelju!</h1>
                    <p>Registruj se sa svojim ličnim podacima kako biste koristili usluge našeg sajta.</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../scripts/script.js"></script>
</body>

</html>