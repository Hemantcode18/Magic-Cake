    <!DOCTYPE html>
    <html lang="zxx">


    <head>
        <?php include_once 'head.php' ?>
    </head>

    <body>

        <!-- Page Preloder -->
        <!-- <div id="preloder">
            <div class="loader"></div>
        </div> -->

        <!-- Offcanvas Menu Begin -->

        <!-- Offcanvas Menu End -->

        <!-- Header Section Begin -->
        <?php include_once 'header.php' ?>

        <!-- Header Section End -->
        <?php include_once 'ajaxcall.php' ?>
        <!-- Hero Section Begin -->
        <?php include_once 'banner.php' ?>
        <!-- Hero Section End -->

        <!-- About Section Begin -->
        <?php include_once 'aboutsec.php' ?>
        <!-- About Section End -->

        <!-- Categories Section Begin -->
        <?php include_once 'categoryslider.php' ?>
        <!-- Categories Section End -->

        <!-- Product Section Begin -->
        <?php include_once 'product.php' ?>
        <!-- Product Section End -->

        <!-- Class Section Begin -->
        <!-- <section class="class spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="class__form">
                            <div class="section-title">
                                <span>Class cakes</span>
                                <h2>Made from your <br />own hands</h2>
                            </div>
                            <form action="#">
                                <input type="text" placeholder="Name">
                                <input type="text" placeholder="Phone">
                                <select>
                                    <option value="">Studying Class</option>
                                    <option value="">Writting Class</option>
                                    <option value="">Reading Class</option>
                                </select>
                                <input type="text" placeholder="Type your requirements">
                                <button type="submit" class="site-btn">registration</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="class__video set-bg" data-setbg="img/class-video.jpg">
                    <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                </div>
            </div>
        </section> -->
        <!-- Class Section End -->

        <!-- Team Section Begin -->
        <section class="team spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <div class="section-title">
                            <span>Our team</span>
                            <h2>Sweet Baker </h2>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="team__btn">
                            <a href="#" class="primary-btn">Join Us</a>
                        </div>
                    </div>
                </div>
                <?php include_once 'admin/dbcontroller.php';
                $handle = new DBcontroller();
                $query3 = "select * from banner where banner_type='Sweet Maker' and status='active' order by banner_index desc";
                $result3 = $handle->executequery($query3);


                ?>
                <div class="row">

                    <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="team__item set-bg" data-setbg="admin/bannerimages/original/T<?php echo $row3['banner_image'] ?>">
                                <div class="team__item__text">
                                    <h6><?php echo $row3['banner_caption'] ?></h6>

                                    <div class="team__item__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        <!-- Team Section End -->

        <!-- Testimonial Section Begin -->
        <section class="testimonial spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <span>Testimonial</span>
                            <h2>Our client say</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="testimonial__slider owl-carousel">


                        <?php
                        $query = "select re.*,rg.* from review re inner join registration rg on re.user_id=rg.registration_id where re.status='show' ORDER BY re.review_id desc";
                        $re = $handle->fetchall($query);

                        foreach ($re as $row) {
                            $no_fill = 5 - $row['rating'];
                            $fill = $row['rating'];
                        ?>
                            <div class="col-lg-6">
                                <div class="testimonial__item">
                                    <div class="testimonial__author">
                                        <div class="testimonial__author__pic">
                                            <?php if (isset($row['image']) and $row['image'] != '') { ?>
                                                <img src="./admin/images/<?php echo $row['image'] ?>">
                                                <?php } else {
                                                if ($row['gender'] == 'Male') { ?>
                                                    <img src="./admin/images/male.jpg">

                                                <?php  } elseif ($row['gender'] == "female") { ?>
                                                    <img src="./admin/images/female.jpg">

                                            <?php  }
                                            }
                                            ?>
                                        </div>
                                        <div class="testimonial__author__text">
                                            <h5><?php echo $row['last_name'] . " " . $row['first_name'] ?></h5>
                                            <span><?php echo $row['city'] ?></span>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <?php
                                        for ($i = 1; $i <= $fill; $i++) { ?>
                                            <span class="icon_star"></span>
                                            <?php }
                                        if ($no_fill != 0) {
                                            for ($j = 1; $j <= $no_fill; $j++) { ?>
                                                <span class="fa fa-star-o"></span>
                                        <?php }
                                        } ?>
                                    </div>
                                    <p><?php echo $row['message'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial Section End -->

        <!-- Instagram Section Begin -->
        <section class="instagram spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 p-0">
                        <div class="instagram__text">
                            <div class="section-title">
                                <span>Follow us on instagram</span>
                                <h2>Sweet moments are saved as memories.</h2>
                            </div>
                            <h5><i class="fa fa-instagram"></i> @sweetcake</h5>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <div class="instagram__pic">
                                    <img src="img/instagram/instagram-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <div class="instagram__pic middle__pic">
                                    <img src="img/instagram/instagram-2.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <div class="instagram__pic">
                                    <img src="img/instagram/instagram-3.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <div class="instagram__pic">
                                    <img src="img/instagram/instagram-4.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <div class="instagram__pic middle__pic">
                                    <img src="img/instagram/instagram-5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                <div class="instagram__pic">
                                    <img src="img/instagram/instagram-3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Instagram Section End -->



        <!-- Footer Section Begin -->
        <?php include_once 'footer.php' ?>
    </body>

    </html>