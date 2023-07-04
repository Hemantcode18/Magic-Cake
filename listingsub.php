   <?php
    if (isset($_POST['cat_id'])) {
        include_once 'admin/dbcontroller.php';
        $handle = new DBcontroller();
        $category_id = $handle->secure($_POST['cat_id']);
        $query = "select * from subcategory where category_id='$category_id' and status='active'";

        $result = $handle->executequery($query);


    ?>


       <div class="col-md-3 mb-1 anyClass">

           <div class="card" style="width: 16rem; ">
               <ul class="list-group list-group-flush">



                   <?php while ($row = mysqli_fetch_array($result)) { ?>
                       <input type="hidden" value="<?php echo $row['category_id'] ?>" id="category_id">

                       <li class="list-group-item" onclick="fetchsubproduct(<?php echo $row['subcategory_id'] ?>)" style="cursor:pointer" id="hover2" style="color:black"><?php echo $row['subcategory_name'] ?></li>



                   <?php } ?>




               </ul>
           </div>
       </div>
   <?php } ?>
   <?php
    $query3 = "select subcategory_id from subcategory where status='active' and category_id='$category_id'";
    $res = $handle->executequery($query3);
    while ($row1 = mysqli_fetch_assoc($res)) {
        $query4 = "select * from product where subcategory_id='" . $row1['subcategory_id'] . "' and status='active'";
        $res2 = $handle->executequery($query4);
        while ($row2 = mysqli_fetch_assoc($res2)) {

    ?>
           <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="product__item">
                   <a href="shop-details.php?p_id=<?php echo $row2['product_id'] ?>">
                       <div class="product__item__pic set-bg" style="background-image:url('admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>')" data-setbg="admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>">

                           <div class="product__label">
                               <span><?php
                                        $query = "select * from category where category_id='$category_id'";

                                        $row = $handle->fetchresult($query);
                                        echo $row['category_name']; ?></span>
                           </div>
                       </div>
                   </a>
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
    } ?>