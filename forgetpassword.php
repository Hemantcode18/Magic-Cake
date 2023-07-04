<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>


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
                        <form action="check_forget.php" method="post">
                            <label>Username</label>
                            <input type="email" placeholder="Enter user name" name="username">
                            <label></label>



                            <button type="submit" name="sendmail" class="site-btn">Send Mail</button>

                        </form>
                        <div class="row mt-5">
                            <div class="col-lg-6 ">
                                <h6 class="font-weight-bolder">Have an account ? <a href="signin.php" class="color" id="hover4">Login In</a></h6>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="class__form">
                        <img src="img/forget.jpg" height="430px" style="border-radius:10px;margin:5px 5px 5px 5px;">
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