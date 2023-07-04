<?php
session_start();
include_once 'admin/dbcontroller.php';
$handle = new DBcontroller();
$query1 = "update registration set status='Logout' where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "')";
$result = $handle->executequery($query1);

unset($_SESSION['session_id']);
unset($_SESSION['otp']);
unset($_SESSION['varify']);
unset($_SESSION['password']);

header('Location:signin.php?message=user successfully signout');
