<?php
session_start();


include_once 'admin/dbcontroller.php';
$handle = new DBcontroller();
$query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
$fetch2 = $handle->fetchresult($query);
$user_id = $fetch2['registration_id'];
$query2 = "select * from wishlist where registration_id='$user_id' and status='pending'";

$count = $handle->numrows($query2); ?>
<a href="wishlist.php" id="wishlistcount"><i class="fa badge fa-lg" value="<?php echo $count ?>"><img src="img/icon/heart.png" alt=""></i></a>