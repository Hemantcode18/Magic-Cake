<?php
session_start();
if (isset($_POST['insertorder'])) {
    include_once './admin/dbcontroller.php';
    $res = $_SESSION['cart'];
    // echo "<pre>";
    // print_r($res);
    $total_item = count($_SESSION['cart']);
    $total_amount = 0;
    foreach ($res as $row) {
        $total_amount = $total_amount + ($row['product_price'] * $row['product_qty']);
        $registration_id = $row['registration_id'];
    }
    $handle = new DBcontroller();
    date_default_timezone_set('Asia/Kolkata');
    $date_time = date('y-m-d H:i:s');
    // echo $date_time;
    // die();
    $query3 = "insert into `order`(`payment_type`,`total_item`,`total_amount`,`date_time`,`registration_id`,`order_status`) values('COD','$total_item','$total_amount','$date_time','$registration_id','Pending')";
    $result3 = $handle->executequery($query3);
    if ($result3) {
        $query = "select * from `order` where registration_id='$registration_id' and order_status='Pending' order by order_id desc";
        $result4 = $handle->fetchresult($query);
        $order_id = $result4['order_id'];
        $concate = "";
        $i = 1;
        foreach ($res as $row) {
            $product_id =  $row['product_id'];
            $product_price = $row['product_price'];
            $product_qty = $row['product_qty'];
            $cart_id = $row['cart_id'];
            if ($i != $total_item) {
                $concate .= "('$product_id','$order_id','$product_price','$product_qty','Pending','$cart_id'),";
                $i++;
            } elseif ($i == $total_item) {
                $concate .= "('$product_id','$order_id','$product_price','$product_qty','Pending','$cart_id')";
            }
            $query6 = "update addtocart set status='success' where cart_id='$cart_id' and registration_id='$registration_id'";
            $run = $handle->executequery($query6);
        }
        $query = "insert into `order_item` (`product_id`,`order_id`,`product_price`,`product_qty`,`or_item_status`,`cart_id`) values" . $concate;

        $final_order = $handle->executequery($query);

        header('Location:complete.php');
    }
} else {
    header('Location:order.php');
}
