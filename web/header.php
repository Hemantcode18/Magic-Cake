   <div class="offcanvas-menu-overlay"></div>
   <div class="offcanvas-menu-wrapper">

       <div class="">
           <div class="offcanvas__cart__links">
               <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
               <a href="wishlist.php"><i class="fa badge fa-lg" value=8><img src="img/icon/heart.png" alt=""></i></a>

           </div>
           <div class="offcanvas__cart__item">
               <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
               <div class="cart__price">Cart: <span>$0.00</span></div>
           </div>
       </div>
       <div class="offcanvas__logo">
           <a href="index.php"><img src="img/logo.png" alt=""></a>
       </div>
       <div id="mobile-menu-wrap"></div>
       <div class="offcanvas__option">
           <ul> <i class="fa fa-user fa-lg"></i>
               <li>Myaccount <span class="arrow_carrot-down"></span>
                   <ul>
                       <a href="signup.php">
                           <li class="font-weight-bolder  " id="hover">SignUp</li>
                       </a>
                       <a href="signin.php">
                           <li class="font-weight-bolder " id="hover">SignIn</li>
                       </a>

                   </ul>
               </li>
               <li><i class="fa badge fa-lg font-weight-bolder" value=8><i class="fa fa-bell"></i></i></li>

           </ul>
       </div>
   </div>

   <?php
    include_once '../admin/dbcontroller.php';
    $handle = new DBcontroller();
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
                                   <i class="fa fa-user fa-lg"></i>
                                   <?php
                                    session_start();
                                    include_once '../admin/dbcontroller.php';
                                    $handle = new DBcontroller();
                                    $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
                                    $row = $handle->fetchresult($query);
                                    if (isset($_SESSION['session_id']) and isset($_SESSION['varify'])) { ?>
                                       <li><?php if ($row['image'] != '') { ?>
                                               <img src="" class="rounded-circle">

                                           <?php   } elseif ($row['gender'] == 'MALE') { ?>
                                               <img src="../img/male.jpg" class="rounded-circle">

                                           <?php } else { ?>
                                               <img src="../img/female.jpg" class="rounded-circle">

                                               <?php } ?>Myaccount <span class="arrow_carrot-down"></span>
                                               <ul class="p-3">
                                                   <a href="signup.php">
                                                       <li class="font-weight-bolder mb-2 " id="hover">Profile</li>
                                                   </a>
                                                   <a href="signin.php">
                                                       <li class="font-weight-bolder " id="hover">View order</li>
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
                           </div>
                           <div class="header__top__right">
                               <div class="header__top__right__links">
                                   <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                                   <a href="wishlist.php"><i class="fa badge fa-lg" value=8><img src="img/icon/heart.png" alt=""></i></a>
                               </div>
                               <div class="header__top__right__cart">
                                   <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""> <span>1</span></a>
                                   <div class="cart__price">Cart: <span>$0.00</span></div>
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
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/web/index.php" or $_SERVER['PHP_SELF'] == "/magic_cake/web/signin.php" or $_SERVER['PHP_SELF'] == "/magic_cake/web/signup.php") { ?>
                               <li class="active"><a href="index.php">Home</a></li>
                           <?php } else { ?>
                               <li><a href="index.php">Home</a></li>
                           <?php  } ?>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/web/about.php") { ?>
                               <li class="active"><a href="about.php">About</a></li>
                           <?php } else { ?>
                               <li><a href="about.php">About</a></li>
                           <?php } ?>
                           <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/web/shop.php") { ?>
                               <li class="active"><a href="shop.php">Shop</a></li>
                           <?php } else { ?>
                               <li><a href="shop.php">Shop</a></li>
                           <?php } ?>
                           <li><a href="#">Categories</a>
                               <ul class="dropdown">
                                   <?php while ($row = mysqli_fetch_array($result)) { ?>
                                       <li><a href=".php" id="hover"><img src="../admin/images/convert/TH<?php echo $row['category_image'] ?>" height="50px">&nbsp;&nbsp;&nbsp;<?php echo $row['category_name'] ?></a></li>
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

     
   </style>

   </head>