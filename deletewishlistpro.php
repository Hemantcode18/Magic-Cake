<?php
if (isset($_POST['w_id'])) {
    include_once 'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $wishlist_id = $handle->secure($_POST['w_id']);
    $query = "delete from wishlist where wishlist_id='$wishlist_id'";
    $result = $handle->executequery($query);
    if ($result) {
    }
}
