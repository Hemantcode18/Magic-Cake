<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php ' ?>
</head>
<?php
if ((isset($_GET['product_id'])) or (isset($_POST['checkoutprocess']))) {
} else { ?>
    <script>
        history.back();
    </script>
<?php }

?>
<style>
    .anyClass::-webkit-scrollbar {
        display: none;

    }
</style>
</style>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <?php include_once 'header.php' ?>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="insertbilling.php" method="post">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="address">
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="pincode">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone">
                                    </div>
                                </div>

                            </div>
                            <form>
                                <input type="checkbox" name="shippingform" value="checked" class="coupon_question " checked> Shipping Address Same As Billing
                            </form>
                            <div class="div1">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Fist Name<span>*</span></p>
                                            <input type="text" name="shipping_first_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Last Name<span>*</span></p>
                                            <input type="text" name="shipping_last_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Country<span>*</span></p>
                                    <input type="text" name="shipping_country">
                                </div>
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" placeholder="Street Address" class="checkout__input__add" name="shipping_address">
                                    <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                                </div>
                                <div class="checkout__input">
                                    <p>Town/City<span>*</span></p>
                                    <input type="text" name="shipping_city">
                                </div>
                                <div class="checkout__input">
                                    <p>Country/State<span>*</span></p>
                                    <input type="text" name="shipping_state">
                                </div>
                                <div class="checkout__input">
                                    <p>Postcode / ZIP<span>*</span></p>
                                    <input type="text" name="shipping_pincode">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Phone<span>*</span></p>
                                            <input type="text" name="shipping_phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email<span>*</span></p>
                                            <input type="text" name="shipping_email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        if (isset($_GET['product_id'])) {
                            $product_id = base64_decode($_GET['product_id']);

                            include_once 'admin/dbcontroller.php';
                            $handle = new DBcontroller();


                            $query = "select * from addtocart where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and product_id='$product_id'and status='pending' ";
                            $result = $handle->fetchall($query);
                        } elseif (isset($_POST['checkoutprocess'])) {

                            $email = $_SESSION['session_id'];

                            include_once 'admin/dbcontroller.php';
                            $handle = new DBcontroller();


                            $query = "select * from addtocart where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and status='pending' ";
                            $result = $handle->fetchall($query);


                            // echo "<pre>";
                            // print_r($result);
                            // die();
                            // $count = $handle->numrows($query);
                            // echo $count;
                            // die();
                        }
                        $_SESSION['cart'] = $result;
                        ?>
                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h6 class="order__title">Your order</h6>

                                <?php
                                $sr_no = 0;
                                $sub_total = 0;
                                ?>
                                <div class="conatiner-fluid ">
                                    <div class="checkout__order__products">
                                        <div class="table-responsive anyClass">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="2%">No</th>
                                                        <th width="48%">Name</th>
                                                        <th width="2%">Qty</th>
                                                        <th width="50%">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($result as $row) {
                                                        $sr_no = $sr_no + 1;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sr_no ?></td>
                                                            <td>
                                                                <?php echo $row['product_name'] ?>
                                                            </td>
                                                            <td><?php echo $row['product_qty'] ?></td>
                                                            <?php
                                                            $total = $row['product_price'] * $row['product_qty'];
                                                            $sub_total = $sub_total + $total;
                                                            ?>

                                                            <td> <i class="fa fa-inr"></i> <?php echo $total ?></td>
                                                        </tr>
                                                    <?php } ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <ul class="checkout__total__all">
                                    <li>Subtotal <span><i class="fa fa-inr"></i> <?php echo $sub_total ?></span></li>
                                    <li>Total <span><i class="fa fa-inr"></i> <?php echo $sub_total ?></span></li>
                                </ul>

                                <div>
                                    <label style="font-weight:bolder">Select Payment Method</label></br>
                                    <input type="radio" value="COD" name="mode">&nbsp;COD</br>
                                    <input type="radio" value="Online" name="mode">&nbsp;Online


                                </div>
                                <button class="site-btn" name="insertbilling">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <?php include_once 'footer.php ' ?>
    <script>
        $(document).ready(function() {
            if ($(".coupon_question").is(":checked")) {
                $(".div1").hide(800);
            }

            $(".coupon_question").click(function() {
                if (!$(this).is(":checked")) {
                    $(".div1").show(800);
                } else {
                    $(".div1").hide(800);
                }
            });
        });
    </script>
    <!-- <script type="text/javascript">
        function showMe(box) {
            var chboxs = document.getElementsByName("shippingform");
            // alert(chboxs.length);
            var vis = "none";
            for (var i = 0; i < chboxs.length; i++) {
                if (chboxs[i].checked) {

                    break;
                } else {
                    vis = "block";
                }
            }
            document.getElementById(box).style.display = vis;
        }
    </script> -->
</body>

</html>