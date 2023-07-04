 <?php
    session_start();
    include_once  'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $product_id = $handle->secure($_POST['p_id']);
    $qty2 = $handle->secure($_POST['qty']);
    $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
    $result = $handle->fetchresult($query);
    $user_id = $result['registration_id'];
    $res = "select * from addtocart where registration_id='$user_id' and status='pending'and product_id='$product_id'";
    $count = $handle->numrows($res);
    $q =  "select * from product where product_id='$product_id'";
    $fetch = $handle->fetchresult($q);

    if (isset($_POST['price']) and isset($_POST['product_nm'])) {
        $p_price = $handle->secure($_POST['price']);
        $p_name = $handle->secure($_POST['product_nm']);
    } else {
        $p_name = $fetch['product_name'];
        $p_price = $fetch['price'];
    }
    $p_image = $fetch['image1'];


    if ($count > 0) {
        if (isset($_POST['price']) and isset($_POST['product_nm'])) {
            $query2 = "update addtocart set product_name='$p_name', product_qty='$qty2',product_price='$p_price'  where registration_id='$user_id' and status='pending'and product_id='$product_id'";
        } else {
            $query2 = "update addtocart set  product_name='$p_name',product_qty='$qty2',product_price='$p_price' where registration_id='$user_id' and status='pending'and product_id='$product_id'";
        }
        $res3 = $handle->executequery($query2);
        if ($res3) {
            echo 0;
        }
    } else {


        $query2 =  "insert into addtocart(`product_name`,`product_image`,`product_price`,`product_qty`,`status`,`product_id`,`registration_id`) values('$p_name','$p_image','$p_price','$qty2','pending','$product_id','$user_id')";
        $res2 = $handle->executequery($query2);
        if ($res2) {
            echo 1;
        }
    }

    ?>