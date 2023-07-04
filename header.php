   <div class="offcanvas-menu-overlay"></div>
   <div class="offcanvas-menu-wrapper">

       <div class="">
           <div class="offcanvas__cart__links">
               <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
               <?php
                include_once 'admin/dbcontroller.php';
                $handle = new DBcontroller();
                session_start();

                if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) {
                    $query = "select * from wishlist where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and status='pending'";
                    $count = $handle->numrows($query); ?>
                   <a href="wishlist.php" id="wishlistcount"><i class="fa badge fa-lg" value="<?php echo $count ?>"><img src="img/icon/heart.png" alt=""></i></a>

               <?php } else { ?>
                   <a href="wishlist.php"><i class="fa badge fa-lg" value="0"><img src="img/icon/heart.png" alt=""></i></a>

               <?php  } ?>

           </div>
           <div class="offcanvas__cart__item">
               <?php
                if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) {
                    $query = "select * from addtocart where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and status='pending'";
                    $count = $handle->numrows($query);
                    $result = $handle->executequery($query);
                    $sub_total = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_price = $row['product_price'] * $row['product_qty'];
                        $sub_total = $sub_total + $total_price;
                    } ?>
                   <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span id="count3"><?php echo $count; ?></span></a>
                   <div class="cart__price">Cart: <span id="subtotal3"><?php echo "<i class='fa fa-inr'></i> " . $sub_total; ?></span></div>

               <?php } else { ?>
                   <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                   <div class="cart__price">Cart: <span><i class='fa fa-inr'></i> 0.00</span></div>

               <?php } ?>
           </div>
       </div>

       <div class="offcanvas__logo">
           <a href="index.php"><img src="img/logo.png" alt=""></a>
       </div>
       <div id="mobile-menu-wrap"></div>
       <div class="offcanvas__option">
           <ul>
               <?php

                if (isset($_SESSION['session_id'])  and isset($_SESSION['varify'])) {

                    $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
                    $row = $handle->fetchresult($query);
                    if ($row['image'] != '') { ?>
                       <img src="admin/images/<?php echo $row['image'] ?>" class="images" class="rounded-circle">
                   <?php } elseif ($row['gender'] == 'Male') {
                        echo '<img id="output_image"  src="img/male.jpg" class="images" class="rounded-circle">';
                    } else {
                        echo '<img id="output_image" src="img/female.jpg" class="images" class="rounded-circle">';
                    } ?>
                   <li>Myaccount <span class="arrow_carrot-down"></span>
                       <ul class="p-3">
                           <a href="profile.php">
                               <li class="font-weight-bolder mb-2 " id="hover">Profile</li>
                           </a>

                           <a href="signout.php">
                               <li class="font-weight-bolder " id="hover">Signout</li>
                           </a>
                       </ul>
                   <li>Welcome <?php echo $row['first_name'] . " " . $row['last_name'] ?></li>


                   </li>
               <?php } else { ?>
                   <li>Myaccount <span class="arrow_carrot-down"></span>
                       <ul class="p-3">
                           <a href="signup.php">
                               <li class="font-weight-bolder mb-2 " id="hover">SignUp</li>
                           </a>
                           <a href="signin.php">
                               <li class="font-weight-bolder " id="hover">SignIn</li>
                           </a>

                       </ul>
                   </li>
               <?php } ?>
               <li><i class="fa badge fa-lg font-weight-bolder" value=8><i class="fa fa-bell"></i></i>

               </li>
               <li>
                   <a href="tel:9429660024" class="call" target="_blank">
                       <i class="fa fa-phone "> &nbsp;+ 91 9429660024</i>
                   </a>

               </li>
           </ul>
       </div>
   </div>

   <?php

    $query = "select * from category where status='active' order by category_id asc";
    $result = $handle->executequery($query);
    ?>
   <header class="header">
       <div class="header__top">
           <div class="container">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="header__top__inner">
                           <div class="header__top__left">
                               <ul>
                                   <?php

                                    if (isset($_SESSION['session_id'])  and isset($_SESSION['varify'])) {

                                        $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
                                        $row = $handle->fetchresult($query);
                                        if ($row['image'] != '') { ?>
                                           <img src="admin/images/<?php echo $row['image'] ?>" class="images" class="rounded-circle">
                                       <?php } elseif ($row['gender'] == 'Male') {
                                            echo '<img id="output_image" src="img/male.jpg" class="images" class="rounded-circle">';
                                        } else {
                                            echo '<img id="output_image" src="img/female.jpg" class="images" class="rounded-circle">';
                                        } ?>
                                       <li>Myaccount <span class="arrow_carrot-down"></span>
                                           <ul class="p-3">
                                               <a href="profile.php">
                                                   <li class="font-weight-bolder mb-2 " id="hover">Profile</li>
                                               </a>

                                               <a href="signout.php">
                                                   <li class="font-weight-bolder " id="hover">Signout</li>
                                               </a>
                                           </ul>
                                       <li>Welcome <?php echo $row['first_name'] . " " . $row['last_name'] ?></li>

                                       </li>
                                   <?php } else { ?>
                                       <li>Myaccount <span class="arrow_carrot-down"></span>
                                           <ul class="p-3">
                                               <a href="signup.php">
                                                   <li class="font-weight-bolder mb-2 " id="hover">SignUp</li>
                                               </a>
                                               <a href="signin.php">
                                                   <li class="font-weight-bolder " id="hover">SignIn</li>
                                               </a>

                                           </ul>
                                       </li>
                                   <?php } ?>
                                   <li><i class="fa badge fa-lg font-weight-bolder" value=8><i class="fa fa-bell"></i></i>

                                   </li>

                               </ul>
                           </div>
                           <div class="header__logo p-1">
                               <a href="index.php"><img src="img/logo.png" alt=""></a>
                               <a href="tel:9429660024" class="call p-3" target="_blank">
                                   <i class="fa fa-phone "> &nbsp;+ 91 9429660024</i>
                               </a>
                           </div>

                           <div class="header__top__right">

                               <div class="header__top__right__links">
                                   <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                                   <?php


                                    if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) {
                                        $query = "select * from wishlist where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and status='pending'";
                                        $count = $handle->numrows($query); ?>
                                       <a href="wishlist.php" id="wishlistcount1"><i class="fa badge fa-lg" value="<?php echo $count ?>"><img src="img/icon/heart.png" alt=""></i></a>
                                   <?php } else { ?>
                                       <a href="wishlist.php"><i class="fa badge fa-lg" value="0"><img src="img/icon/heart.png" alt=""></i></a>

                                   <?php  } ?>
                               </div>
                               <div class="header__top__right__cart">

                                   <?php if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) {
                                        $query = "select * from addtocart where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "') and status='pending'";
                                        $count = $handle->numrows($query);
                                        $result = $handle->executequery($query);
                                        $sub_total = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $total_price = $row['product_price'] * $row['product_qty'];
                                            $sub_total = $sub_total + $total_price;
                                        } ?>
                                       <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span id="count4"><?php echo $count; ?></span></a>
                                       <div class="cart__price">Cart: <span id="subtotal4"><?php echo "<i class='fa fa-inr'></i> " . $sub_total; ?></span>
                                       </div>
                                   <?php } else { ?>
                                       <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                                       <div class="cart__price">Cart: <span><i class='fa fa-inr'></i> 0.00</span></div>
                                   <?php } ?>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="canvas__open"><i class="fa fa-bars"></i></div>
           </div>
       </div>
       <div class="container">
           <div class="row">
               <div class="col-lg-12">
                   <nav class="header__menu mobile-menu">
                       <ul>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/index.php" or $_SERVER['PHP_SELF'] == "/magic_cake/web/signin.php" or $_SERVER['PHP_SELF'] == "/magic_cake/web/signup.php") { ?>
                               <li class="active"><a href="index.php">Home</a></li>
                           <?php } else { ?>
                               <li><a href="index.php">Home</a></li>
                           <?php  } ?>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/about.php") { ?>
                               <li class="active"><a href="about.php">About</a></li>
                           <?php } else { ?>
                               <li><a href="about.php">About</a></li>
                           <?php } ?>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/shop.php") { ?>
                               <li class="active"><a href="shop.php">Shop</a></li>
                           <?php } else { ?>
                               <li><a href="shop.php">Shop</a></li>
                           <?php } ?>
                           <li><a href="#">Categories</a>
                               <ul class="dropdown">
                                   <?php
                                    $catquery = "select * from category where status='active'";
                                    $catresult = $handle->executequery($catquery);

                                    while ($row = mysqli_fetch_array($catresult)) { ?>
                                       <li><a href="productlisting.php?cat_id=<?php echo $row['category_id'] ?>" id="hover2"><img src="admin/images/convert/TH<?php echo $row['category_image'] ?>" height="50px">&nbsp;&nbsp;&nbsp;<?php echo $row['category_name'] ?></a>
                                       </li>

                                   <?php } ?>

                               </ul>
                           </li>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/web/blog.php") { ?>
                               <li class="active"><a href="blog.php">Blog</a></li>
                           <?php } else { ?>
                               <li><a href="blog.php">Blog</a></li>
                           <?php } ?>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/web/contact.php") { ?>
                               <li class="active"><a href="contact.php">Contact</a></li>
                           <?php } else { ?>
                               <li><a href="contact.php">Contact</a></li>
                           <?php } ?>

                       </ul>
                   </nav>
               </div>
           </div>
       </div>
   </header>
   <style>
       #hover:hover {
           color: #f08632;
       }

       #hover2:hover {
           background-color: #f08632;
           color: white;
       }

       #hover4:hover {

           color: black;
       }

       .color {
           color: #f08632;
       }

       .bgcolor {
           background-color: #f08632;
       }

       .badge:after {
           content: attr(value);
           font-size: 12px;
           color: #fff;
           background: red;
           border-radius: 50%;
           padding: 0 5px;
           position: relative;
           left: -8px;
           top: -10px;
           opacity: 0.9;
       }

       .images {
           height: 40px;
           width: 40px;
           border-radius: 20px;
       }

       .active1 {
           background-color: #f08632;
           color: white;

       }

       .call {
           color: black;
       }

       .call:hover {


           color: #fd7e14;
           font-weight: bolder;

       }

       .whatsapp_float {
           position: fixed;
           bottom: 40px;
           right: 5px;



       }
   </style>
   <!-- <div class="whatsapp_float">
       <a href=" https://wa.me/9429660024" target="_blank">
           <img style="z-index:-1" src="img/WhatsApp-1-735x400-removebg-preview (1).png" width="120px" class="whatsapp_float_btn" /></a>


   </div> -->