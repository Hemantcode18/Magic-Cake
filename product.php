 <?php
    include_once 'admin/dbcontroller.php';
    $query = "select p.*,s.subcategory_id,subcategory_name,category_id from product p INNER JOIN subcategory s where p.subcategory_id=s.subcategory_id order by p.product_id desc";

    $handle = new DBcontroller();
    $result = $handle->executequery($query);

    ?>
 <section class="product spad">
     <div class="container">
         <h3 class="text-center font-weight-bolder">New <span class="color">Arrival</span></h3>
         <hr class="mb-5">
         <div class="row">
             <?php while ($row1 = mysqli_fetch_assoc($result)) { ?>
                 <div class="col-lg-3 col-md-6 col-sm-6">
                     <div class="product__item">
                         <a href="shop-details.php?p_id=<?php echo $row1['product_id'] ?>">
                             <div class="product__item__pic set-bg" data-setbg="admin/productimages/convertimages/RC<?php echo $row1['image1'] ?>">

                                 <div class="product__label">
                                     <span><?php $category_id = $row1['category_id'];
                                            $query = "select * from category where category_id='$category_id'";

                                            $row = $handle->fetchresult($query);
                                            echo $row['category_name']; ?></span>
                                 </div>
                             </div>
                         </a>
                         <div class="product__item__text">
                             <h6><a href="#"><?php echo $row1['product_name'] ?></a></h6>
                             <div class="product__item__price"><i class="fa fa-inr"></i> <?php echo $row1['price'] ?></div>
                             <div class="cart_add">
                                 <?php
                                    if (isset($_SESSION['session_id'])) { ?>
                                     <a id="hover" onclick="addtowishlist(<?php echo $row1['product_id'] ?>)" style="border-color:white;cursor:pointer "><i class="fa fa-heart"></i></a>&nbsp;&nbsp;
                                     <a id="hover" onclick="addtocart(<?php echo $row1['product_id'] ?>)" id=" hover" style="border-color:white; cursor:pointer">Add to cart</a>
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
 </section>