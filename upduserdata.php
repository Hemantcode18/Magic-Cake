<?php

session_start();
include './admin/dbcontroller.php';
$handle = new DBcontroller();
$email = $_SESSION['session_id'];


$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$phone_no = $_POST['phone_no'];
$gender = $_POST['gender'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$address = $_POST['address'];

$query = "update registration set first_name='$first_name',last_name='$last_name',phone_no='$phone_no',gender='$gender',city='$city',state='$state',country='$country',address='$address' where email='$email' ";
$res = $handle->executequery($query);
if ($res) {
    echo 1;
} else {
    echo 0;
}
