<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <?php include_once 'header.php' ?>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>About</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>About</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__video set-bg" data-setbg="img/about-video.jpg">
                        <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>About Cake shop</span>
                            <h2>Cakes and bakes from the house of Queens!</h2>
                        </div>
                        <p>The "Cake Shop" is a Jordanian Brand that started as a small family business. The owners are
                            Dr. Iyad Sultan and Dr. Sereen Sharabati, supported by a staff of 80 employees.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about__bar">
                        <div class="about__bar__item">
                            <p>Cake design</p>
                            <div id="bar1" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="95"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Class</p>
                            <div id="bar2" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="80"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Recipes</p>
                            <div id="bar3" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="90"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

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

    <!-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>

</html>