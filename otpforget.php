<!DOCTYPE html>
<html lang="zxx">
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:signin.php');
}

?>

<head>
    <?php include_once 'head.php' ?>
</head>
<script>
    $(document).ready(function() {
        setInterval(otp, 1000);
    });
    i = 0;

    function otp() {
        i++;
        $.ajax({
            url: 'otp_time.php',
            type: "post",
            data: {
                count: i
            },
            success: function(data) {
                $('#otp_time').html(data);
            },
        });
    }
</script>

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
                            <span>Class cakes</span>
                            <h2>OTP Varification</h2>
                        </div>
                        <?php
                        if (isset($_GET['message'])) {
                            echo "<div class='alert alert-danger font-weight-bolder '>" . $_GET['message'] . "</div>";
                        } else {
                        }
                        ?>
                        <form action="processforgetotp.php" method="post">
                            <label>OTP</label>
                            <input type="text" minlength="6" maxlength="6" pattern="[0-9]+" placeholder="Enter the OTP" name="otp">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" name="submit" id="hover2" class="site-btn">Submit</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="ResendOTP" id="hover2" class="site-btn">Resend OTP</button>
                                </div>

                            </div>

                        </form>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <h6 id="otp_time" class="float-left font-weight-bolder">60 SECOND</h6>

                                <h6 class="float-right font-weight-bolder">New User?<a class="color" href="" id="hover4">Signup</a></h6>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="class__form">
                        <img src="img/email-featured.jpg" height="430px" style="border-radius:10px;margin:5px 5px 5px 5px;">
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