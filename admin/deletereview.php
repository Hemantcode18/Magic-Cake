<?php
include_once 'dbcontroller.php';
if (isset($_GET['review_id'])) {

    $handle = new DBcontroller();
    $id = $handle->secure($_GET['review_id']);
    $query = "delete from review where review_id='$id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewreview.php?success=delete');
    } else {
        header('Location:viewreview.php?error=review is not deleted');
    }
}
