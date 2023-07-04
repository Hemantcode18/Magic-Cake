<?php
$category_id = $_GET['cat_id'];
session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>
</head>
<style>
    .hover5:hover {
        color: white;
    }
</style>
<script src="./js/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {

        $(document).on("keyup", "#search", function() {
            var a = $(this).val();
            var cat_id = $('#category_id').val();
            var page = 1;
            $.ajax({
                url: 'live_serach.php',
                type: 'post',
                data: {
                    search: a,
                    page_ser: page,
                    cat_id: cat_id

                },
                success: function(data) {
                    $('.search_res').html(data);


                }


            });

        });
    });

    // function catlist(value) {
    //     $.ajax({
    //         url: "listingsub.php",
    //         type: "post",
    //         data: {
    //             cat_id: value,
    //         },
    //         success: function(data) {
    //             $('#subproductlist').html(data);
    //         }

    //     });

    // }


    function fetchsubproduct(value) {

        var cat_id = $('#category_id').val();

        $.ajax({
            url: "productlisting2.php",
            type: "post",
            data: {
                cat_id: cat_id,
                subcat_id: value

            },
            success: function(data) {

                $('#pagination').html(data);
            }

        });
        $(document).ready(function() {

            $(document).on("keyup", "#search", function() {
                var cat_id = $('#category_id').val();
                var a = $('#search').val();
                $.ajax({
                    url: "productlisting2.php",
                    type: "post",
                    data: {
                        cat_id: cat_id,
                        subcat_id: value,
                        search: a
                    },
                    success: function(data) {

                        $('#pagination').html(data);
                    }

                });
            });
        });

    }

    function pagination(page) {
        var cat_id = $('#category_id').val();

        var subcat_id = $('#subcategory_id').val();


        $.ajax({
            type: "POST",
            url: "subcatlistpagination.php",
            data: {
                cat_id: cat_id,
                subcat_id: subcat_id,
                page_ser: page,

            },
            success: function(data) {

                $('#pagination').html(data);
            }
        });
    }
</script>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <?php include_once 'header.php';
    ?>

    <!-- Header Section End -->
    <?php include_once 'ajaxcall.php' ?>
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
                                <select id="hover2" onchange="fetchsubproduct(this.value)">
                                    <option value="" selected>
                                        Subcategory</option>
                                    <?php $q = "select * from subcategory where category_id='$category_id'";
                                    $result = $handle->executequery($q);
                                    while ($subcategory = mysqli_fetch_array($result)) { ?>

                                        <option value="<?php echo $subcategory['subcategory_id'] ?>" id="hover2 ">
                                            <?php echo $subcategory['subcategory_name'] ?></option>


                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="text" id="search" placeholder="Search">
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
            <div id="pagination">
                <div class="search_res">
                    <hr class="mb-3 ">
                    <div class="row">

                        <?php
                        if (isset($_GET['page'])) {

                            $page = $_GET['page'];
                        } else {


                            $page = 1;
                        }
                        $num_per_page = 7;
                        $start_from = ($page - 1) * 7;
                        $cat_id = $_REQUEST['cat_id'];

                        $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id='$category_id' and product.subcategory_id=subcategory.subcategory_id and subcategory.category_id='$category_id' limit $start_from,$num_per_page";
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
                </div>
                <?php
                $query3 = "select subcategory_id from subcategory where status='active' and category_id='$category_id'";
                $res = $handle->executequery($query3);
                $sum = 0;
                while ($row1 = mysqli_fetch_assoc($res)) {

                    $query4 = "select * from product where subcategory_id='" . $row1['subcategory_id'] . "' and status='active'";

                    $count = $handle->numrows($query4);
                    $sum = $sum + $count;
                }

                $total_page = ceil($sum / $num_per_page);
                ?>

                <div class="shop__last__option">
                    <div class="row">
                        <d iv class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__pagination">
                                <?php if ($page > 1) { ?>
                                    <a onclick="pagination(<?php echo $page - 1 ?>)"><span class="arrow_carrot-left"></span></a>
                                <?php } ?>
                                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                    <?php if ($i == $page) { ?>
                                        <a style="background-color:black; color:white" onclick="pagination(<?php echo $i ?>)"><?php echo $i ?></a>

                                    <?php    } else { ?>
                                        <a onclick="pagination(<?php echo $i ?>)"><?php echo $i ?></a>
                                <?php   }
                                } ?>



                                <?php if ($page < $total_page) { ?>
                                    <a onclick="pagination(<?php echo $page + 1 ?>)"><span class="arrow_carrot-right"></span></a>
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
    </section>
    <!-- Shop Section End -->

    <!-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>

</html>