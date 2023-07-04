<?php
include_once 'dbcontroller.php';
if (isset($_GET['category_id'])) {

    $handle = new DBcontroller();
    $id = $handle->secure($_GET['category_id']);
    $query = "delete from category where category_id='$id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewcategory.php?success=delete');
    } else {
        header('Location:viewcategory.php?error=category is not deleted');
    }
}
