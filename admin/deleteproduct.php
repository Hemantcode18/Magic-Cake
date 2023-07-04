<?php
include_once 'dbcontroller.php';
if (isset($_GET['product_id'])) {

    $handle = new DBcontroller();
    $id = $handle->secure($_GET['product_id']);
    $query = "delete from product where product_id='$id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewproduct.php?success=delete');
    } else {
        header('Location:viewproduct.php?error=product is not deleted');
    }
}
