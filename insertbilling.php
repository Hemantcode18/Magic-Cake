<?php
session_start();
if (isset($_POST['insertbilling'])) {
    if ($_POST['mode'] == 'COD') {
        include_once "./admin/dbcontroller.php";
        $obj = new DBcontroller();

        $name = $_POST['first_name'] . " " . $_POST['last_name'];
        $country = $_POST['country'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $phone = $_POST['phone'];
        session_start();
        $email = $_SESSION['session_id'];
        $query = "select * from registration where email='$email'";
        $fetch = $obj->fetchresult($query);
        $_SESSION['product_id'] = $_POST['product_id'];
        $registration_id = $fetch['registration_id'];
        $query2 = "insert into billing(`name`,`address`,`city`,`state`,`country`,`pincode`,`phone_number`,`email_id`,`registration_id`) values('$name','$address','$city','$state','$country','$pincode','$phone','$email','$registration_id')";
        $result = $obj->executequery($query2);


        if (!isset($_POST['shippingform'])) {
            $shipping_name = $_POST['shipping_first_name'] . " " . $_POST['shipping_last_name'];
            $shipping_country = $_POST['shipping_country'];


            $shipping_address = $_POST['shipping_address'];

            $shipping_city = $_POST['shipping_city'];
            $shipping_state = $_POST['shipping_state'];
            $shipping_pincode = $_POST['shipping_pincode'];
            $shipping_phone = $_POST['shipping_phone'];
            $query3 = "insert into shipping(`shipping_name`,`shipping_address`,`shipping_city`,`shipping_state`,`shipping_country`,`shipping_pincode`,`shipping_phone_no`,`shipping_email_id`,`registration_id`) values('$shipping_name','$shipping_address','$shipping_city','$shipping_state','$shipping_country','$shipping_pincode','$phone','$email','$registration_id')";
            $result2 = $obj->executequery($query3);
        }

        if ($result) {
            header('Location:order.php');
        }
    }
}
