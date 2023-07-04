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

    <style>
        form i {
            margin-left: -50px;
            cursor: pointer;
        }

        input[type="password"] {
            font: small-caption;
            font-size: 15px;

        }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        // $(document).on("click", "#togglePassword", function() {

        //     if ($("#adminpassword").attr('type') == 'password') {

        //         $("#adminpassword").attr('type', 'text');
        //         $(this).attr('title', 'hide password');
        //         $(this).removeClass('fa fa-eye');
        //         $(this).addClass('fa fa-eye-slash');
        //     } else {
        //         $("#adminpassword").attr('type', 'password');
        //         $(this).attr('title', 'show password');
        //         $(this).removeClass('fa fa-eye-slash');
        //         $(this).addClass('fa fa-eye');
        //     }
        // });
        $(document).on("click", "#eye", function() {
            if ($('#forgetpass').attr('type') == "password") {

                $("#forgetpass").attr('type', 'text');
                $(this).attr('title', 'hide password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');


            } else {
                $("#forgetpass").attr('type', 'password');
                $(this).attr('title', 'show password');
                $(this).removeClass('fa fa-eye-slash');
                $(this).addClass('fa fa-eye');

            }
        });
        $(document).on("click", "#eye2", function() {
            if ($('#forgetpass2').attr('type') == "password") {

                $("#forgetpass2").attr('type', 'text');
                $(this).attr('title', 'hide password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');


            } else {
                $("#forgetpass2").attr('type', 'password');
                $(this).attr('title', 'show password');
                $(this).removeClass('fa fa-eye-slash');
                $(this).addClass('fa fa-eye');

            }
        });
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

                            <h2>Forget Password</h2>
                        </div>
                        <?php
                        if (isset($_GET['message'])) {
                            echo "<div class='alert alert-danger font-weight-bolder '>" . $_GET['message'] . "</div>";
                        } else {
                        }
                        ?>
                        <form action="check_forgetpass.php" method="post">

                            <label>New Password</label>
                            <input id="forgetpass" type="password" placeholder="Enter new password" name="new_password"><i id="eye" class="fa fa-eye fa-2x"></i>
                            <label>Repeat Password</label>
                            <input id="forgetpass2" type="Password" placeholder="Enter repeate password" name="repeat_password"><i id="eye2" class="fa fa-eye fa-2x"></i>


                            <button type="submit" name="submitnewpass" class="site-btn">Submit</button>

                        </form>

                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="class__form">
                        <img src="img/class/cake-maker-21.jpg" height="430px" style="border-radius:10px;margin:5px 5px 5px 5px;">
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