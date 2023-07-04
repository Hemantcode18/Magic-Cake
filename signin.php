<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>

    <style>
        @media (min-width:544px) {
            .color {
                font-size: 5px;
            }


        }

        .pass {
            font: small-caption;
            font-size: 30px;
        }

        @media (min-width:768px) {
            .color {
                font-size: 15px;
            }
        }

        @media (min-width:992px) {
            .color {
                font-size: 15px;
            }
        }
    </style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->

    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include_once 'header.php' ?>
    <!-- Header Section End -->
    <!-- Class Section Begin -->
    <section class="class spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="class__form order-sm-last">
                        <img src="img/class/cake-maker-21.jpg" height="430px" style="border-radius:10px;">
                    </div>
                </div>
                <div class="col-lg-6 order-sm-first col-11 mx-auto">
                    <div class="class__form">
                        <div class="section-title">

                            <h2>SignIn</h2>
                        </div>
                        <?php
                        if (isset($_GET['message'])) {
                            echo "<div class='alert alert-danger font-weight-bolder '>" . $_GET['message'] . "</div>";
                        } else {
                        }
                        ?>
                        <form action="check_signin.php" method="post">
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo '<label>Username</label>';
                                echo '<input type="text" value=' . $_SESSION['email'] . ' placeholder="Enter user name" name="username">';
                            } else {
                            ?>
                                <label>Username</label>
                                <input type="text" placeholder="Enter user name" name="username">
                            <?php }
                            ?>
                            <label>Password</label>
                            <input type="Password" class="pass" placeholder="Enter password" name="password">


                            <button type="submit" class="site-btn">Signin</button>

                        </form>
                        <div class="row mt-5">
                            <div class="col-7">
                                <h6 class="float-left font-weight-bolder"><i class="fa fa-key color"></i> <a href="forgetpassword.php" class="color" id="hover4">Forget Password</a></h6>
                            </div>
                            <div class="col-5">
                                <h6 class="float-right font-weight-bolder">New User?<a class="color" href="signup.php" id="hover4">Signup</a></h6>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- Class Section End -->
    <!-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>

</html>