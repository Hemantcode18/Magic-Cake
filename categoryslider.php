<?php
include_once 'admin/dbcontroller.php';
$handle = new DBcontroller();
$query = "select * from category where status='active'";
$result = $handle->executequery($query);

?>


<div class="categories ">
    <div class="container">
        <h3 class="text-center font-weight-bolder "><span class="color">Cate</span>gories</h3>
        <hr class="mb-5">

        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <a href="productlisting.php?cat_id=<?php echo $row['category_id'] ?>" id="hover">
                        <div class="product__item__pic set-bg rounded-circle" data-setbg="admin/images/convert/TH<?php echo $row['category_image'] ?>">
                            <div class="product__label">
                                <span id="hover2"><?php echo $row['category_name'] ?></span>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>