<?php
include_once 'admin/dbcontroller.php';
session_start();
if ((isset($_POST['username']) and isset($_POST['password']))) {
    $handle = new dbcontroller();
    $username = $handle->secure($_POST['username']);
    $password = $handle->secure($_POST['password']);
    $new_password = md5($password);
    $query = "select * from login where username='$username' and password='$new_password' and type='user'";
    $count = $handle->numrows($query);
    if ($count > 0) {
        $_SESSION['session_id'] = $username;
        $_SESSION['varify'] = 'done';
        $query1 = "update registration set status='Login' where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "')";
        $result = $handle->executequery($query1);
        unset($_SESSION['email']);
        header('Location:index.php?message=user are successfully login');
    } else {

        header('Location:signin.php?message=Please enter correct detail');
    }
}
