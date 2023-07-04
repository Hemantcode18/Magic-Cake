<?php
include_once 'dbcontroller.php';
if (isset($_GET['banner_id'])) {

    $handle = new DBcontroller();
    $id = $handle->secure($_GET['banner_id']);
    $query = "delete from banner where banner_id='$id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewbanner.php?success=delete');
    } else {
        header('Location:viewbanner.php?error=banner is not deleted');
    }
}
