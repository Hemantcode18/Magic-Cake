<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>
</head>
<script src="js/jquery-3.3.1.min.js"></script>
<script>
    function pagination(page) {
        // alert(page);
        $.ajax({
            url: 'shop_pagination.php',
            type: 'post',
            data: {
                page_ser: page
            },
            success: function(data) {
                // alert(data);
                $('#shop_pagination').html(data);
            }

        });

    }
    $(document).ready(function() {
        // alert("hello");
        $(document).on("keyup", "#search_shop", function() {
            var a = $(this).val();


            var page = 1;
            $.ajax({
                url: 'live_shopserach.php',
                type: 'post',
                data: {
                    search: a,
                    page_ser: page
                },
                success: function(data) {
                    // alert(data);
                    $('#shop_pagination').html(data);


                }


            });

        });
    });
</script>

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
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="shop__option">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="shop__option__search">
                            <form action="#">

                                <input type="text" id="search_shop" placeholder="Search">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            <select>
                                <option value="">Default sorting</option>
                                <option value="">A to Z</option>
                                <option value="">1 - 8</option>
                                <option value="">Name</option>
                            </select>
                            <a href="#"><i class="fa fa-list"></i></a>
                            <a href="#"><i class="fa fa-reorder"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <style>
                .anyClass {
                    height: 350px;
                    overflow-y: scroll;
                    overflow-x: hidden;

                }

                .anyClass::-webkit-scrollbar {
                    display: none;
                }
            </style> -->
            <div id="shop_pagination">
                <div class="search_res">
                    <hr class="mb-3 ">
                    <div class="row">

                        <?php
                        if (isset($_GET['page'])) {

                            $page = $_GET['page'];
                        } else {


                            $page = 1;
                        }
                        $num_per_page = 8;
                        $start_from = ($page - 1) * 8;


                        $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id  limit $start_from,$num_per_page";
                        $res2 = $handle->executequery($query4);

                        while ($row2 = mysqli_fetch_assoc($res2)) {

                        ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <a href="shop-details.php?p_id=<?php echo $row2['product_id'] ?>">
                                        <div class="product__item__pic set-bg" data-setbg="admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>">

                                            <div class="product__label">
                                                <span><?php

                                                        echo $row2['category_name']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                    <input type="hidden" id="subcategory_id" value="<?php echo $row2['subcategory_id'] ?>">
                                    <input type="hidden" id="category_id" value="<?php echo $row2['category_id'] ?>">

                                    <div class="product__item__text">
                                        <h6><a href="#"><?php echo $row2['product_name'] ?></a></h6>
                                        <div class="product__item__price"><i class="fa fa-inr"></i> <?php echo $row2['price'] ?>
                                        </div>
                                        <div class="cart_add">
                                            <?php
                                            if (isset($_SESSION['session_id'])) { ?>
                                                <a id="hover" onclick="addtowishlist(<?php echo $row2['product_id'] ?>)" style="border-color:white;cursor:pointer "><i class="fa fa-heart"></i></a>&nbsp;&nbsp;
                                                <a id="hover" onclick="addtocart(<?php echo $row2['product_id'] ?>)" id=" hover" style="border-color:white; cursor:pointer">Add to cart</a>
                                            <?php } else { ?>
                                                <a href="signin.php?message=Firtly signin then wishlist product" id="hover" style="border-color:white"><i class="fa fa-heart"></i></a>&nbsp;&nbsp;
                                                <a href="signin.php?message=Firstly signin then addtocart product" id="hover" style="border-color:white">Add to cart</a>

                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <?php
                    $query5 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id";
                    $count = $handle->numrows($query5);
                    $total_page = ceil($count / $num_per_page);
                    ?>

                    <div class="shop__last__option">
                        <div class="row">
                            <d iv class="col-lg-6 col-md-6 col-sm-6 ">
                                <div class="shop__pagination">
                                    <?php if ($page > 1) { ?>
                                        <a style="cursor:pointer" onclick="pagination(<?php echo $page - 1 ?>)"><span class="arrow_carrot-left"></span></a>
                                    <?php } ?>
                                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <?php if ($i == $page) { ?>
                                            <a style="background-color:black; color:white; cursor:pointer" onclick="pagination(<?php echo $i ?>)"><?php echo $i ?></a>

                                        <?php    } else { ?>
                                            <a style="cursor:pointer" onclick="pagination(<?php echo $i ?>)"><?php echo $i ?></a>
                                    <?php   }
                                    } ?>



                                    <?php if ($page < $total_page) { ?>
                                        <a style="cursor:pointer" onclick="pagination(<?php echo $page + 1 ?>)"><span class="arrow_carrot-right"></span></a>
                                    <?php } ?>
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__last__text">
                                <p>Showing 1-9 of 10 results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>

</html>