<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->
    <!-- Offcanvas Menu Begin -->
    <?php include_once 'header.php' ?>
    <!-- Header Section End -->
    <script>
        function deletecartproduct(id) {
            cart_id = id;

            swal({
                    title: "Are you sure want to delete ?",
                    text: "Once deleted, you will not be able to recover this addtocart product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type: "POST",
                            url: "deletecartpro.php",
                            data: {
                                cart_id: cart_id,
                            },
                            success: function(data) {
                                $('#delete_' + id).html(data);
                                cartcount();
                                subtotal();
                            }

                        });
                        swal("Poof! Your addtocart product has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal(" ", "Your addtocart product is safe!", "info");
                    }
                });

        }

        function cartcount() {
            $.ajax({
                type: "POST",
                url: "cartcount.php",

                success: function(data2) {

                    $('#count3').html(data2);
                    $('#count4').html(data2);

                }
            });
        }

        function cartClick(val, id) {

            //  var qty = $("#qty_" + id).val();
            //  alert(qty);
            //  if (val === 1) {
            //      qty = parseInt(qty) + 1;
            //      $("#qty_" + id).val(qty);
            //  } else {
            //      qty = qty - 1;
            //      $("#qty_" + id).val(qty);

            //  }
            var qty1 = $("#qty_" + id).val();

            if (val == 1) {
                //  qty = parseInt(qty1);

                qty = parseInt(qty1) + 1;
                //  alert(qty);
            } else {
                qty2 = parseInt(qty1)
                if (qty2 >= 2) {
                    qty = qty2 - 1;
                } else {
                    qty = 1;


                }
            }
            var price = $("#price_" + id).val();
            $.ajax({
                type: "POST",
                url: "updateqty.php",
                data: {
                    cart_id: id,
                    product_qty: qty,
                    product_price: price,
                },
                success: function(data) {
                    $("#total_" + id).html(data);
                    subtotal();

                }
            });
            //  var price = $("#price_" + id).val();

            //  var total_price;
            //  total_price = price * qty;
        }
        //  document.getElementById('total_' + id).innerHTML = total_price;
        function subtotal() {
            $.ajax({
                type: "POST",
                url: "cartsubtotal.php",

                success: function(data2) {

                    $("#subtotal").html(data2);
                    $("#subtotal2").html(data2);
                    $("#subtotal3").html(data2);
                    $("#subtotal4").html(data2);

                }
            });
        }
    </script>



    <!-- Breadcrumb Begin -->

    <?php if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) { ?>

        <!-- Breadcrumb End -->
        <?php
        include_once 'admin/dbcontroller.php';
        $handle = new DBcontroller();
        $query = "select * from addtocart where status='pending' and registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') order by cart_id desc ";
        $result = $handle->executequery($query);
        $count = $handle->numrows($query);
        ?>
        <div class="breadcrumb-option shopping-cart cart__total">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="breadcrumb__text">
                            <h2>Shopping cart</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="breadcrumb__links">
                            <a href="index.php">Home</a>
                            <span>Shopping cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($count > 0) { ?>

            <!-- Shopping Cart Section Begin -->
            <section class="shopping-cart spad" id="message">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="shopping__cart__table">
                                <table>
                                    <thead>
                                        <tr class="text-center">
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sub_total = 0;
                                        while ($row = mysqli_fetch_array($result)) { ?>
                                            <tr id="delete_<?php echo $row['cart_id'] ?>">
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="admin/productimages/convertimages/RC<?php echo $row['product_image'] ?>" height="70px" width="70px" alt="">
                                                    </div>
                                                    <input type="hidden" id="price_<?php echo $row['cart_id'] ?>" value="<?php echo $row['product_price'] ?>">
                                                    <div class="product__cart__item__text">
                                                        <h6><?php echo $row['product_name'] ?></h6>
                                                        <h5><i class="fa fa-inr"></i> <?php echo $row['product_price'] ?></h5>
                                                    </div>
                                                </td>
                                                <td class="quantity__item ">
                                                    <div class="quantity mx-5">
                                                        <div class="pro-qty">
                                                            <span style="color:black;" class="dec qtybtn" onclick="cartClick(0,<?php echo $row['cart_id'] ?>);">-</span>
                                                            <input type="text" id="qty_<?php echo $row['cart_id'] ?>" value="<?php echo $row['product_qty'] ?>">
                                                            <span style="color:black" class="inc qtybtn" onclick="cartClick(1,<?php echo $row['cart_id'] ?>);">+</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                $total_price = $row['product_price'] * $row['product_qty'];
                                                $sub_total = $sub_total + $total_price;
                                                ?>
                                                <td class="cart__price text-center " id="total_<?php echo $row['cart_id'] ?>"><i class="fa fa-inr"></i> <?php echo  $total_price ?></td>
                                                <td class="cart__close" style="cursor:pointer" onclick="deletecartproduct(<?php echo $row['cart_id'] ?>)"><span class="icon_close"></span></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-sm-6">
                                    <center>
                                        <div class="continue__btn">
                                            <a href="shop.php" id="hover2">Continue Shopping</a>
                                        </div>
                                    </center>
                                </div>

                            </div>

                        </div>
                        <div class=" col-lg-4">
                            <form action="checkout.php" method="post">
                                <div class="cart__total">
                                    <h6>Cart total</h6>
                                    <ul>
                                        <li>Subtotal <span id="subtotal"><i class="fa fa-inr"></i> <?php echo $sub_total ?></span></li>
                                        <li>Total <span id="subtotal2"><i class="fa fa-inr"></i> <?php echo $sub_total ?></span></li>

                                    </ul>
                                    <button name="checkoutprocess" class="primary-btn">Proceed to checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <section class="shopping-cart cart__total">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-6 ">
                            <center>
                                <div id="container1">
                                    <img src="admin/images/174-1749396_empty-cart-your-cart-is-empty-hd-png.png" class="rounded-circle mb-3">
                                    <!-- <a href="#">

                                <div class="">
                                    <div class="mask" style="background-color: rgba(57, 192, 237, 0.2)"></div>
                                    <a href="signin.php?message=Firsly signin then addtocart product" class="primary-btn rounded">Signin Now</a>
                                </div>
                            </a> -->


                                </div>
                            </center>

                        </div>
                        <div class="col-lg-3">

                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- Shopping Cart Section End -->
    <?php } else { ?>
        <section class="shopping-cart cart__total  ">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-6 ">
                        <center>
                            <div id="container1">
                                <img src="admin/images/mobile-login-concept-illustration_114360-83.jpg" class="rounded-circle mb-3">
                                <a href="signin.php"><button class="btn ">Signin Now</button></a>
                                <!-- <a href="#">

                                <div class="">
                                    <div class="mask" style="background-color: rgba(57, 192, 237, 0.2)"></div>
                                    <a href="signin.php?message=Firsly signin then addtocart product" class="primary-btn rounded">Signin Now</a>
                                </div>
                            </a> -->


                            </div>
                        </center>

                    </div>
                    <div class="col-lg-3">

                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <style>
        #container1 {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        #container1 img {
            width: 100%;
            height: auto;
        }

        #container1 .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #555;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;

            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #container1 .btn:hover {
            background-color: black;
        }
    </style>
    <!-- < !-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>
<style>
</style>

</html>