<?php

if (isset($_POST['cakekg'])) {
    include_once 'dbcontroller.php';
    $handle = new DBcontroller();
    $product_id = $handle->secure($_POST['product_name']);
    $cake_qty = $handle->secure($_POST['cake_qty']);
    $cake_kg = $handle->secure($_POST['cake_kg']);
    $rename_product = $handle->secure($_POST['productre_name']);
    $cake_price = $handle->secure($_POST['cake_price']);
    $query1 = "select * from product_kg where product_id='$product_id' and cake_kg='$cake_kg'";
    $count = $handle->numrows($query1);
    if ($count > 0) {
        header('Location:addcakekg.php?message=Kg already exist in cake');
    } else {


        $query = "insert into product_kg(`cake_qty`,`cake_kg`,`cake_price`,`product_rename`,`product_id`,`status`) values('$cake_qty','$cake_kg','$cake_price','$rename_product','$product_id','active') " or die('query failed');
        $res = $handle->executequery($query);
        if ($res) {
            header('Location:viewkg.php?message=data inserted successfully');
        }
    }
}
