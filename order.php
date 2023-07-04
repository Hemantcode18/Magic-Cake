<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php ' ?>
</head>
<style>
    .anyClass::-webkit-scrollbar {
        display: none;
    }
</style>
</style>

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
                        <h2>Order</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Confirm Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div>
                <div class="vertical_post check_box_agile">
                    <h5 style="font-weight:bolder; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:25px; color:black; font-style:italic">COD</h5>
                    <form action="insertorder.php" method="post" class="cashon_delivery">
                        <div class="checkbox">
                            <div class="check_box_one cashon_delivery p-2">
                                <label class="anim">
                                    <input style="height:15px; width:15px;" type="checkbox" class="checkbox" name="cash" value="Cash on Delivery" required>&nbsp;&nbsp;
                                    <span style="font-size:20px; font-style:italic"> Sure you want to make order.</span>
                                </label>
                            </div>
                        </div>
                        <br>

                        <button class="site-btn" name="insertorder">CONFIRM ORDER</button>
                        <div class="site-btn" style="cursor:pointer" onclick="history.back()">Back</div>

                        </br>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <?php include_once 'footer.php ' ?>
    <script>
        $(document).ready(function() {
            if ($(" .coupon_question").is(":checked")) {
                $(".div1").hide(800);
            }
            $(".coupon_question").click(function() {
                if (!$(this).is(":checked")) {
                    $(".div1").show(800);
                } else {
                    $(".div1").hide(800);
                }
            });
        });
    </script>
    <!-- <script type="text/javascript">
        function showMe(box) {
            var chboxs = document.getElementsByName("shippingform");
            // alert(chboxs.length);
            var vis = "none";
            for (var i = 0; i < chboxs.length; i++) {
                if (chboxs[i].checked) {

                    break;
                } else {
                    vis = "block";
                }
            }
            document.getElementById(box).style.display = vis;
        }
    </script> -->
</body>

</html>