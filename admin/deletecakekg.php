<?php
include_once 'dbcontroller.php';
if (isset($_GET['kg_id'])) {

    $handle = new DBcontroller();
    $kg_id = $handle->secure($_GET['kg_id']);
    $query = "delete from product_kg where kg_id='$kg_id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewkg.php?success=delete');
    } else {
        header('Location:viewkg.php?error=cake kg is not deleted');
    }
}
