<?php
include_once '../core/dbConnection.php';

$error_message = "";
$success_message = "";

if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        $error_message = "Molimo vas da unesete sve potrebne podatke.";
    } else {
        $check_user_query = "SELECT * FROM `users` WHERE `email`='$email' LIMIT 1";
        $result = mysqli_query($conn, $check_user_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $error_message = "Korisnik sa ovim email-om već postoji. Molimo vas da se prijavite.";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert_user_query = "INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name', '$email', '$password_hashed', 'korisnik')";
            mysqli_query($conn, $insert_user_query);
            $success_message = "Uspešno ste se registrovali! Molimo vas da se prijavite.";
        }
    }
}
?>