<?php
if (isset($_POST['cart_id'])) {
    include_once 'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $cart_id = $handle->secure($_POST['cart_id']);
    $query = "delete from addtocart where cart_id='$cart_id'";
    $result = $handle->executequery($query);
    if ($result) {
    }
}
