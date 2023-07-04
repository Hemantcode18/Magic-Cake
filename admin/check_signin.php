<?php
include_once 'dbcontroller.php';
if (isset($_POST['signin']) and isset($_POST['email']) and isset($_POST['password'])) {
    $handle = new DBcontroller();
    $email = $handle->secure($_POST['email']);
    $password = $handle->secure($_POST['password']);
    $query = "select * from login where username='$email' and password='$password' and type='admin'";
    $count = $handle->numrows($query);
    if ($count > 0) {
        session_start();
        $_SESSION['session_key'] = $email;
        if (isset($_SESSION['session_key'])) {
            header('Location:index.php?success=login');
        } else {
            header('Location:signin.php?error=Your session is not created');
        }
    } else {
        header('Location:signin.php?error=Please enter correct detail');
    }
} else {
}
