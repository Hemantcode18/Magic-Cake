  <?php

    include './admin/dbcontroller.php';
    $handle = new DBcontroller();
    $search = $handle->secure($_POST['search']);


    ?>
  <div id="shop_pagination">
      <div class="search_res">
          <hr class="mb-3 ">
          <div class="row">

              <?php
                if (isset($_POST['page_ser'])) {

                    $page = $_POST['page_ser'];
                } else {


                    $page = 1;
                }
                $num_per_page = 8;
                $start_from = ($page - 1) * 8;


                $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id and product.product_name like '%$search%' limit $start_from,$num_per_page";
                $countproductwise = $handle->numrows($query4);
                if ($countproductwise == 0) {
                    $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id and subcategory.subcategory_name like '%$search%' limit $start_from,$num_per_page";
                    $countsubcategorywise = $handle->numrows($query4);
                    if ($countsubcategorywise == 0) {
                        $query4 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id and category.category_name like '%$search%' limit $start_from,$num_per_page";
                    }
                }
                $res2 = $handle->executequery($query4);
                $count = $handle->numrows($query4);
                if ($count > 0) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {

                ?>
                      <div class="col-lg-3 col-md-6 col-sm-6">
                          <div class="product__item">
                              <a href="shop-details.php?p_id=<?php echo $row2['product_id'] ?>">
                                  <div class="product__item__pic set-bg" style="background-image:url('admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>')" data-setbg="admin/productimages/convertimages/RC<?php echo $row2['image1'] ?>">

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

                    $query5 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id and product.product_name like '%$search%'";
                    $countproductwisepagination = $handle->numrows($query5);
                    if ($countproductwisepagination == 0) {
                        $query5 = "select product.*,category.category_id,category_name,subcategory.subcategory_id,subcategory_name from category,subcategory,product where category.category_id=subcategory.category_id and subcategory.subcategory_id=product.subcategory_id and subcategory.subcategory_name like '%$search%'";
                    }

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
          <?php } else { ?>
              <center>
                  <div class="col-lg-9 col-md-6 col-sm-6">
                      <img src="admin/images/no-product-found.jpg" class="img-fluid" width="1200px">
                  </div>
              </center>

          <?php } ?>
          <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="shop__last__text">
                  <p>Showing 1-9 of 10 results</p>
              </div>
          </div>
          </div>
      </div>
  </div>