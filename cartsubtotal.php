<?php
session_start();
if (isset($_SESSION['session_id'])){
    include_once 'admin/dbcontroller.php';
$handle = new DBcontroller();
$query = "select * from addtocart where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and status='pending'";
$result = $handle->executequery($query);
$sub_total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_price = $row['product_price'] * $row['product_qty'];
    $sub_total = $sub_total + $total_price;
}
echo "<i class='fa fa-inr'></i> " . $sub_total;
}
