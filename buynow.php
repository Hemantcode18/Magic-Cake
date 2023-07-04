 <?php
    session_start();
    include_once  'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $product_id = $handle->secure($_POST['product_id']);
    $qty2 = $handle->secure($_POST['qty1']);
    $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
    $result = $handle->fetchresult($query);
    $user_id = $result['registration_id'];
    $res = "select * from addtocart where registration_id='$user_id' and status='pending'and product_id='$product_id'";
    $count = $handle->numrows($res);
    $q =  "select * from product where product_id='$product_id'";
    $fetch = $handle->fetchresult($q);

    if (isset($_POST['product_rename']) and isset($_POST['price2'])) {

        $p_name = $_POST['product_rename'];
        $p_price = $_POST['price2'];
    } else {
        $p_name = $fetch['product_name'];
        $p_price = $fetch['price'];
    }
    $p_image = $fetch['image1'];
    if ($count > 0) {
        $query3 = "update addtocart set product_qty='$qty2' where registration_id='$user_id' and product_id='$product_id'";
        $res3 = $handle->executequery($query3);
        header('Location:checkout.php?product_id=' . base64_encode($product_id));
    } else {
        $query2 =  "insert into addtocart(`product_name`,`product_image`,`product_price`,`product_qty`,`status`,`product_id`,`registration_id`) values('$p_name','$p_image','$p_price','$qty2','pending','$product_id','$user_id')";
        $res2 = $handle->executequery($query2);
        if ($res2) {
            header('Location:checkout.php?product_id=' . base64_encode($product_id));
        }
    }

    ?>