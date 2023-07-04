<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>
</head>

<body>
    <!-- Offcanvas Menu Begin -->
    <?php include_once 'header.php' ?>
    <!-- Header Section End -->
    <style>
        .anyClass {
            height: 350px;
            overflow-y: scroll;
            overflow-x: hidden;

        }

        .anyClass::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script>
        function clickcake(id) {

            var price = $('#cakeprice_' + id).val();
            $.ajax({
                type: "POST",
                url: "cakekgprice.php",
                data: {
                    price: price,
                    kg_id: id,

                },
                success: function(data) {
                    $('#price').html(data);

                }
            });

        }

        $(document).ready(function() {

            $('.star-1').on("click", function() {



                $('.star-1').removeClass('fa fa-star-o');
                $('.star-1').addClass('fa fa-star');
                $('.star-2,.star-3,.star-4,.star-5').removeClass('fa fa-star');
                $('.star-2,.star-3,.star-4,.star-5').addClass('fa fa-star-o');
                $('#rating').val(1);

            });
            $('.star-2').on("click", function() {
                $('.star-1,.star-2').removeClass('fa fa-star-o');
                $('.star-1,.star-2').addClass('fa fa-star');
                $('.star-3,.star-4,.star-5').removeClass('fa fa-star');
                $('.star-3,.star-4,.star-5').addClass('fa fa-star-o');
                $('#rating').val(2);
            });
            $('.star-3').on("click", function() {
                $('.star-1,.star-2,.star-3').removeClass('fa fa-star-o');
                $('.star-1,.star-2,.star-3').addClass('fa fa-star');
                $('.star-4,.star-5').removeClass('fa fa-star');
                $('.star-4,.star-5').addClass('fa fa-star-o');
                $('#rating').val(3);
            });
            $('.star-4').on("click", function() {
                $('.star-1,.star-2,.star-3,.star-4').removeClass('fa fa-star-o');
                $('.star-1,.star-2,.star-3,.star-4').addClass('fa fa-star');
                $('.star-5').removeClass('fa fa-star');
                $('.star-5').addClass('fa fa-star-o');
                $('#rating').val(4);
            });
            $('.star-5').on("click", function() {
                $('.star-1,.star-2,.star-3,.star-4,.star-5').removeClass('fa fa-star-o');
                $('.star-1,.star-2,.star-3,.star-4,.star-5').addClass('fa fa-star');

                $('#rating').val(5);
            });


            $('.star-group i').on("click", function() {

                var f = $('#message').val();
                if (f == "" || f == null) {
                    $('#message').css("border-color", "#cd2d00");
                    $('.ratsub').attr('disabled', true);
                    $(".message").text("* You have to enter your message!");
                    $('.ratsub').css('background-color', "red");

                }
                $('#message').on("keyup", function() {
                    var f = $('#message').val();


                    if (f == "" || f == null) {
                        $('#message').css("border-color", "#cd2d00");
                        $('.ratsub').attr('disabled', true);
                        $(".message").text("* You have to enter your message!");
                        $('.ratsub').css('background-color', "red");

                    } else if (!($('#message').val().match('^[a-zA-Z ,]{1,100}$'))) {
                        $('#message').css("border-color", "#cd2d00");
                        $('.ratsub').attr('disabled', true);
                        $(".message").text("* Only character are allowed");
                        $('.ratsub').css('background-color', "red");


                    } else if ((f.length <= 2) || (f.length > 100)) {
                        $('#message').css("border-color", "#cd2d00");
                        $('.ratsub').attr('disabled', true);
                        $(".message").text("*please enter the corect name between 2 and 100");
                        $('.ratsub').css('background-color', "red");

                    } else {

                        $('#message').css("border-color", "green");
                        $('.ratsub').attr('disabled', false);
                        $(".ratsub").css('background-color', "#fd7e14");
                        $('.message').text(" ");
                    }
                });

            });
            $('.ratsub').attr("disabled", true);
        });

        function addtocart(id) {
            var qty = $("#qty").val();
            var price = $('#price2').val();
            var product_rename = $('#product_rename').val();

            $.ajax({
                type: "POST",
                url: "addcartproduct.php",
                data: {
                    p_id: id,
                    qty: qty,
                    price: price,
                    product_nm: product_rename,
                },
                success: function(data) {
                    // alert(data);
                    if (data == 0) {
                        swal("oops !", "product already added to cart", "info");
                    } else if (data == 1) {
                        swal("Good Job !", "Product successfully added to cart", "success");
                    }

                    cartcount();
                    subtotal();
                }
            });
        }

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
                }

            );
        }

        function cartcount() {
            $.ajax({
                    type: "POST",
                    url: 'cartcount.php',

                    success: function(data2) {

                        $('#count3').html(data2);
                        $('#count4').html(data2);

                    }
                }

            );
        }

        function addtowishlist(id) {
            var price = $('#price2').val();
            var product_rename = $('#product_rename').val();

            $.ajax({
                type: "POST",
                url: "wishlistproduct.php",
                data: {
                    p_id: id,
                    price: price,
                    product_nm: product_rename,
                },
                success: function(data) {
                    alert(data);
                    wishlistcount();
                }
            });
        }

        function wishlistcount() {
            $.ajax({
                type: "POST",
                url: "wishlistcount.php",

                success: function(data3) {
                    $('#wishlistcount').html(data3);
                    $('#wishlistcount1').html(data3);
                }
            });
        }

        function review(id) {

            var rat = $('#rating').val();
            var mes = $('#message').val();
            $.ajax({
                type: "POST",
                url: "check_rating.php",
                data: {
                    product_id: id,
                    rating: rat,
                    message: mes,

                },
                success: function(data) {
                    $('#loadreview').html(data);
                    $('#number').val('');
                    $('#message').val('');
                    $('.star-1,.star-2,.star-3,.star-4,.star-5').removeClass('fa fa-star');
                    $('.star-1,.star-2,.star-3,.star-4,.star-5').addClass('fa fa-star-o');
                    $('.ratsub').attr("disabled", true);
                }
            });

        }
    </script>


    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <?php
    include_once 'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $product_id = $handle->secure($_GET['p_id']);
    $query = "select p.*,s.subcategory_id,subcategory_name,category_id from product p INNER JOIN subcategory s where p.product_id='$product_id' and p.subcategory_id=s.subcategory_id ";
    $row = $handle->fetchresult($query);
    $path = "admin/productimages/convertimages/RC";

    ?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Product detail</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <span><?php echo $row['subcategory_name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">
                        <div class="product__details__big__img">
                            <img class="big_img" src="<?php echo $path . $row['image1'] ?>" alt="error">
                        </div>
                        <div class="product__details__thumb">
                            <div class="pt__item active">
                                <img data-imgbigurl="<?php echo $path . $row['image1'] ?>" src="<?php echo $path . $row['image1'] ?>" alt="">
                            </div>
                            <div class="pt__item">
                                <img data-imgbigurl="<?php echo $path . $row['image2'] ?>" src="<?php echo $path . $row['image2'] ?>" alt="">
                            </div>
                            <div class="pt__item">
                                <img data-imgbigurl="<?php echo $path . $row['image3'] ?>" src="<?php echo $path . $row['image3'] ?>" alt="">
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                $query = "select * from category where category_id='" . $row['category_id'] . "'";
                $result = $handle->fetchresult($query);
                $cat_name = $result['category_name']; ?>

                <div class="col-lg-6">
                    <form action="buynow.php" method="post">
                        <div class="product__details__text">
                            <div class="product__label"> <?php echo $cat_name;
                                                            ?></div>
                            <span id="price">
                                <h4><?php echo $row['product_name'] ?></h4>

                                <h5 id=""><i class="fa fa-inr"></i> <?php echo $row['price'] ?></h5>
                            </span>
                            <p><?php echo $row['product_des'] ?></p>
                            <ul>
                                <li>SKU: <span>17</span></li>
                                <li>Category: <span>
                                        <?php echo $cat_name;
                                        ?></span></li>

                                <li>Flavour: <span><?php echo $row['product_flavour'] ?></span></li>
                            </ul>
                            <?php
                            $query1 = "select * from product_kg where status='active' and product_id='" . $row['product_id'] . "'";
                            $result = $handle->executequery($query1);
                            while ($row2 = mysqli_fetch_assoc($result)) {
                            ?>
                                <input type="hidden" id="cakeprice_<?php echo $row2['kg_id'] ?>" value="<?php echo $row2['cake_price'] ?>">
                                <a type="button" style="cursor:pointer; color:white; border-radius:35px" onclick="clickcake(<?php echo $row2['kg_id'] ?>)" class="primary-btn ml-2 mb-3 mt-3 "><?php echo $row2['cake_kg'] . "Kg" ?></a>
                            <?php } ?>



                            <div class="product__details__option">

                                <div class="quantity ml-2">
                                    <div class="pro-qty ">
                                        <span class="dec qtybtn">-</span>

                                        <input type="text" id="qty" value="1" name="qty1">
                                        <span class="inc qtybtn">+</span>
                                    </div>
                                </div>
                                <?php if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) { ?>

                                    <a class="heart__btn " id="hover2" style="cursor:pointer" onclick="addtowishlist(<?php echo $row['product_id'] ?>)"><span class="icon_heart_alt"></span></a>
                                <?php } else { ?>

                                    <a href="signin.php?message=Firstly signin then add product to wishlist" class="heart__btn"><span class="icon_heart_alt"></span></a>
                                <?php } ?>
                            </div>
                            <?php if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) { ?>
                                <a onclick="addtocart(<?php echo $row['product_id'] ?>)" style="cursor:pointer; color:white" class="primary-btn ml-2 mt-3"> <i class="fa fa-shopping-cart"></i>Add to cart</a>

                                <input type="hidden" value="<?php echo $row['product_id'] ?>" id="product_id" name="product_id">

                                <button type="submit" style="cursor:pointer; color:white; " class="primary-btn ml-2 mt-3 border-0"><i class="fa fa-shopping-bag"> </i> Buy Now <i class="fa fa-arrow-right"></i></button>

                            <?php } else { ?>
                                <a href="signin.php?message=Firstly signin then addtocart product" style="cursor:pointer; color:white" class="primary-btn ml-2 mt-3" disabled><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                <a href="signin.php?message=Firstly signin then buy product" style="cursor:pointer; color:white" class="primary-btn ml-2 mt-3" disabled><i class="fa fa-shopping-bag"> </i> Buy Now <i class="fa fa-arrow-right"></i> </a>

                            <?php } ?>
                        </div>
                    </form>
                </div>

            </div>
            <div class="product__details__tab ">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Reviews</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <!-- <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <p>This delectable Strawberry Pie is an extraordinary treat filled with sweet and
                                        tasty chunks of delicious strawberries. Made with the freshest ingredients, one
                                        bite will send you to summertime. Each gift arrives in an elegant gift box and
                                        arrives with a greeting card of your choice that you can personalize online!</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <p>This delectable Strawberry Pie is an extraordinary treat filled with sweet and
                                        tasty chunks of delicious strawberries. Made with the freshest ingredients, one
                                        bite will send you to summertime. Each gift arrives in an elegant gift box and
                                        arrives with a greeting card of your choice that you can personalize online!2
                                    </p>
                                </div>
                            </div>
                        </div> -->
                        <?php

                        $q1 = "select * from product where subcategory_id='" . $row['subcategory_id'] . "'";
                        $res = $handle->executequery($q1);

                        ?>

                        <?php
                        $query = "select review.*,registration.registration_id,first_name,last_name,gender,image, product.product_id,product_name from review,registration,product where review.user_id=registration.registration_id and product.product_id=review.product_id and product.product_id='$product_id' order by review.review_id desc limit 5";
                        $result2 = $handle->executequery($query);
                        ?>
                        <div class="tab-pane active" id="tabs-3" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6 anyClass" id="loadreview">
                                            <?php while ($row = mysqli_fetch_assoc($result2)) { ?>

                                                <div class="media mt-4">
                                                    <?php if (!empty($row['image'])) { ?>
                                                        <img src="admin/images/<?php echo $row['image'] ?>" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">
                                                    <?php } elseif ($row['gender'] == 'Male') {
                                                    ?>

                                                        <img src="admin/images/male.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">

                                                    <?php } elseif ($row['gender'] == 'Female') { ?>
                                                        <img src="admin/images/female.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">

                                                    <?php } ?>
                                                    <div class="media-body">
                                                        <h6><?php echo $row['last_name'] . " " . $row['first_name'] ?><small> - <i><?php echo $row['added_on'] ?>
                                                                </i></small></h6>
                                                        <div class="text-primary mb-2" style="color:#fd7e14">
                                                            <?php
                                                            $no_fill = 5 - $row['rating'];
                                                            $fill = $row['rating'];
                                                            for ($i = 1; $i <= $fill; $i++) {
                                                                echo '<i class="fa fa-star"></i>';
                                                            }
                                                            if ($no_fill != 0) {
                                                                for ($j = 1; $j <= $no_fill; $j++) {
                                                                    echo ' <i class="fa fa-star-o"></i>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <h6><?php echo $row['message'] ?></h6>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 ">
                                            <h4 class="my-3">Leave a review</h4>
                                            <small>Your email address will not be published. Required fields are marked *</small>
                                            <div class="d-flex my-3">

                                            </div>
                                            <div class="message" style="color:red"></div>
                                            <form action="check_rating.php" method="post">
                                                <input type="hidden" name="p_id" value="<?php echo $id ?>" />

                                                <input type="hidden" id="rating" class="rating" value="1" name="rating">

                                                <div class="text-primary ">
                                                    <label for="message" class="text-dark">Your Rating *</label><br>
                                                    <div class="py-3 star-group" style="color:#fd7e14;cursor:pointer ">

                                                        <i class="fa fa-star-o p-1 fa-lg star-1"></i>
                                                        <i class="fa fa-star-o p-1 fa-lg star-2"></i>
                                                        <i class="fa fa-star-o p-1 fa-lg star-3"></i>
                                                        <i class="fa fa-star-o p-1 fa-lg star-4"></i>
                                                        <i class="fa fa-star-o p-1 fa-lg star-5"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">Your Review *</label>
                                                    <textarea id="message" cols="30" rows="5" name="message" class="form-control"></textarea>
                                                </div>
                                                <?php if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) { ?>

                                                    <div class="form-group mb-0 text-center">
                                                        <input type="button" value="Leave Your Review" onclick="review(<?php echo $product_id ?>)" class="btn btn-dark px-5 ratsub" name="ratsub">
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-group mb-0 text-center">
                                                        <input type="submit" value="Login is required" class="btn btn-dark px-5 " name="ratsub" disabled>
                                                    </div>
                                                <?php } ?>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Products Section Begin -->
    <section class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="related__products__slider owl-carousel">
                    <?php while ($row = mysqli_fetch_array($res)) { ?>
                        <div class="col-lg-3">
                            <div class="product__item">
                                <a href="shop-details.php?p_id=<?php echo $row['product_id'] ?>">
                                    <div class="product__item__pic set-bg" data-setbg="admin/productimages/convertimages/RC<?php echo $row['image1'] ?>">
                                        <div class="product__label">
                                            <span><?php echo $cat_name; ?></span>
                                        </div>
                                    </div>
                                </a>
                                <div class="product__item__text">
                                    <h6><a href="#"><?php echo $row['product_name'] ?></a></h6>

                                    <div class="product__item__price"><i class="fa fa-inr"></i> <?php echo $row['price'] ?></div>
                                    <div class="cart_add">

                                        <?php if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) { ?>
                                            <a id="hover" onclick="addtowishlist(<?php echo $row['product_id'] ?>)" style="border-color:white;cursor:pointer "><i class="fa fa-heart"></i></a>&nbsp;&nbsp;
                                            <a id="hover" onclick="addtocart(<?php echo $row['product_id'] ?>)" id=" hover" style="border-color:white; cursor:pointer">Add to cart</a>
                                        <?php } else { ?>
                                            <a href="signin.php?message=Firtly signin then wishlist product" id="hover" style="border-color:white"><i class="fa fa-heart"></i></a>&nbsp;&nbsp;
                                            <a href="signin.php?message=Firstly signin then addtocart product" id="hover" style="border-color:white">Add to cart</a>

                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    </section>
    <style>
        .fa-star,
        .fa-star-o {
            color: #fd7e14;
        }
    </style>
    <!-- Related Products Section End -->

    <!-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>

</html>