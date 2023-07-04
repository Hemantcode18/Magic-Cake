<?php
include_once 'dbcontroller.php';
if (isset($_GET['contact_id'])) {

    $handle = new DBcontroller();
    $id = $handle->secure($_GET['contact_id']);
    $query = "delete from contact where contact_id='$id'";
    $result = $handle->executequery($query);
    if ($result) {
        header('Location:viewcontact.php?success=delete');
    } else {
        header('Location:viewcontact.php?error=contact is not deleted');
    }
}
