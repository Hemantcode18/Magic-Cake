<?php
session_start();


include_once 'admin/dbcontroller.php';
$handle = new DBcontroller();
$query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
$fetch2 = $handle->fetchresult($query);
$user_id = $fetch2['registration_id'];
$query2 = "select * from addtocart where registration_id='$user_id' and status='pending'";

$count = $handle->numrows($query2);
echo $count;
