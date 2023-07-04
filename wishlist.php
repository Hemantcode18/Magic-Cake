<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>
</head>
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

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <?php include_once 'header.php ' ?>
    <!-- Header Section End -->
    <script>
        function deletewishlistproduct(id) {
            wishlist_id = id;
            swal({
                    title: "Are you sure want to delete ?",
                    text: "Once deleted, you will not be able to recover this wishlist product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type: "POST",
                            url: "deletewishlistpro.php",
                            data: {
                                w_id: wishlist_id,
                            },
                            success: function(data) {
                                $('#delete2_' + wishlist_id).html(data);
                                wishlistcount();
                            }

                        });


                        swal("Poof! Your wishlist product has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal(" ", "Your wishlist product is safe!", "info");
                    }
                });

        }

        function wishlistcount() {
            $.ajax({
                type: "POST",
                url: "wishlistcount.php",

                success: function(data4) {
                    $('#wishlistcount').html(data4);
                    $('#wishlistcount1').html(data4);
                }
            });
        }

        function addtocart(id) {
            qty = 1;
            $.ajax({
                type: "POST",
                url: "addcartproduct.php",
                data: {
                    p_id: id,
                    qty: qty,
                },
                success: function(data) {
                    // alert(data);
                    if (data == 0) {
                        swal("oops !", "product already added to cart", "info");
                    } else if (data == 1) {
                        swal("Good Job !", "Product successfully added to cart", "success");
                    }

                    cartcount();
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
                    subtotal()
                }
            });
        }

        function subtotal() {
            $.ajax({
                type: "POST",
                url: "cartsubtotal.php",

                success: function(data2) {


                    $("#subtotal3").html(data2);
                    $("#subtotal4").html(data2);

                }
            });
        }
    </script>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option shopping-cart cart__total">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Wishlist</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Wishlist Section Begin -->

    <?php
    if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) {
        include_once 'admin/dbcontroller.php';
        $handle = new DBcontroller();
        $query = "select * from wishlist where status='pending' and registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') order by wishlist_id desc ";
        $result = $handle->executequery($query);
        $count = $handle->numrows($query);
        if ($count > 0) { ?>
            <section class="wishlist spad ">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="wishlist__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Stock</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr id="delete2_<?php echo $row['wishlist_id'] ?>">
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="admin/productimages/convertimages/RC<?php echo $row['product_image'] ?>" height="70px" width="70px" alt="">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6><?php echo $row['product_name'] ?></h6>
                                                    </div>
                                                </td>
                                                <td class="cart__price"><i class="fa fa-inr"></i>
                                                    <?php echo $row['product_price'] ?></td>
                                                <?php $query1 = "select qty from product where product_id='" . $row['product_id'] . "'";
                                                $fetch = $handle->fetchresult($query1);

                                                if ($fetch['qty'] <= 0) {
                                                    echo ' <td class="cart__stock">Out stock</td>';
                                                } else {
                                                    echo ' <td class="cart__stock">In stock</td>';
                                                }
                                                ?>

                                                <td class="cart__btn"><a onclick="addtocart(<?php echo $row['product_id'] ?>)" style="cursor:pointer" class="primary-btn">Add to cart</a></td>
                                                <td class="cart__close" onclick="deletewishlistproduct(<?php echo $row['wishlist_id'] ?>)"><span class="icon_close"></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
                                    <img src="admin/images/orageemptywishlist.jpg" class="rounded-circle mb-3">
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
        <?php }
    } else { ?>

        <section class="shopping-cart cart__total">
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
    <!-- Wishlist Section End -->

    <?php include_once 'footer.php' ?>
</body>

</html>