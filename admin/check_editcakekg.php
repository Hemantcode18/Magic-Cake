<?php
if (isset($_POST['cakekg'])) {
    include_once 'dbcontroller.php';
    $handle = new DBcontroller();
    $kg_id = $handle->secure($_POST['kg_id']);
    $product_id = $handle->secure($_POST['product_name']);
    $cake_qty = $handle->secure($_POST['cake_qty']);
    $cake_kg = $handle->secure($_POST['cake_kg']);
    $product_rename = $handle->secure($_POST['product_rename']);
    $cake_price = $handle->secure($_POST['cake_price']);
    $query = "update product_kg set cake_qty='$cake_qty',cake_kg='$cake_kg',cake_price='$cake_price',product_rename='$product_rename',product_id='$product_id' where kg_id='$kg_id' " or die('query failed');
    $res = $handle->executequery($query);
    if ($res) {
        header('Location:viewkg.php?message=data updated successfully');
    }
}
