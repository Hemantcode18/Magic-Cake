<?php
include './admin/dbcontroller.php';
$handle = new DBcontroller();
$search = $handle->secure($_POST['search']);
$category_id = $handle->secure($_POST['cat_id']);
$page = $handle->secure($_POST['page_ser']);


?>

<div class="row">

    <?php
    if (isset($_POST['page_ser'])) {

        $page = $_POST['page_ser'];
    } else {


        $page = 1;
    }
    $num_per_page = 12;
    $start_from = ($page - 1) * 12;

    $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id='$category_id' and product.subcategory_id=subcategory.subcategory_id and product.product_name like '%$search%' limit $start_from,$num_per_page";
    $countproductwise = $handle->numrows($query4);
    if ($countproductwise == 0) {
        $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id='$category_id' and product.subcategory_id=subcategory.subcategory_id and subcategory.subcategory_name like '%$search%' limit $start_from,$num_per_page";

        $countsubcategorywise = $handle->numrows($query4);
    }
    $res2 = $handle->executequery($query4); ?>
    <input type="hidden" value="<?php echo $category_id ?>" id="category_id">
    <?php $count = $handle->numrows($query4);
    if ($count > 0) {
        while ($row2 = mysqli_fetch_assoc($res2)) {

    ?> <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product__item">
                    <a href="shop-details.php?p_id=<?php echo $row2['product_id'] ?>">
                        <div class="product__item__pic set-bg" style="background-image:url('admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>')" data-setbg="admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>">

                            <div class="product__label">
                                <span><?php

                                        echo $row2['category_name']; ?></span>
                            </div>
                        </div>
                    </a>
                    <input type="hidden" id="category_id" value="<?php echo $row2['category_id'] ?>">
                    <input type="hidden" id="subcategory_id" value="<?php echo $row2['subcategory_id'] ?>">
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $row2['product_name'] ?></a></h6>
                        <div class="product__item__price"><i class="fa fa-inr"></i> <?php echo $row2['price'] ?></div>
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



<?php } else { ?>
    <center>
        <div class="col-lg-9 col-md-6 col-sm-6">
            <img src="admin/images/no-product-found.jpg" class="img-fluid" width="1200px">
        </div>
    </center>
<?php  } ?>