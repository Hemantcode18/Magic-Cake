<?php
session_start();
$_SESSION['session_key'];
unset($_SESSION['session_key']);
header('Location:signin.php?message=Signout successfully');
