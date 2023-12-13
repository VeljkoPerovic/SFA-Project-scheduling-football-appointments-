<?php

include_once '../core/dbConnection.php';

$error_message_signin = "";

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_user_query = "SELECT * FROM `users` WHERE `email`='$email' LIMIT 1";
    $result = mysqli_query($conn, $check_user_query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: ../public/index.php?page=home");
        exit();
    } else {
        $error_message_signin = "Email ili lozinka nisu ispravni. Molimo vas pokušajte ponovo.";
    }
}
?>