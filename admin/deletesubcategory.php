<?php
include_once 'dbcontroller.php';
if (isset($_GET['subcategory_id'])) {

    $handle = new DBcontroller();
    $id = $handle->secure($_GET['subcategory_id']);
    $query = "delete from subcategory where subcategory_id='$id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewsubcategory.php?success=delete');
    } else {
        header('Location:viewsubcategory.php?error=subcategory is not deleted');
    }
}
