    <!DOCTYPE html>
    <html lang="zxx">


    <head>
        <?php include_once 'head.php' ?>
    </head>
    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        .horizontal-timeline .items {
            border-top: 2px solid #ddd;
        }

        .horizontal-timeline .items .items-list {
            position: relative;
            margin-right: 0;
        }

        .horizontal-timeline .items .items-list:before {
            content: "";
            position: absolute;
            height: 8px;
            width: 8px;
            border-radius: 50%;
            background-color: #ddd;
            top: 0;
            margin-top: -5px;
        }

        .horizontal-timeline .items .items-list {
            padding-top: 15px;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('input[type="radio"]').click(function() {

                if ($("input[type='radio']").not(":checked")) {
                    $('#but').hide();
                }
                if ($("input[type='radio']").is(":checked")) {
                    $('#but').show(500);
                    $('.comment').show(500);
                    $('.comment1').show(500);
                    $('input[type="radio"]').not(':checked').hide(400);
                    $('input[type="radio"]').not(':checked').siblings('label').hide(400);
                    $('input[type="radio"]').is(':checked').siblings('label').show(400);




                }
            });
            $('#but').hide();
            $('.comment').hide();
            $('.comment1').hide();
            $('.change').click(function() {
                $('input[type="radio"]').not(':checked').show();
                $('input[type="radio"]').not(':checked').siblings('label').show();
                $('input[type="radio"]').is(':checked').siblings('label').show();

            });
            $('.comment').on('focus', function() {
                $('.comment').val('');
            });







        });
    </script>

    <body>

        <!-- Page Preloder -->
        <!-- <div id="preloder">
            <div class="loader"></div>
        </div> -->

        <!-- Offcanvas Menu Begin -->

        <!-- Offcanvas Menu End -->
        <?php include_once 'ajaxcall.php' ?>
        <!-- Header Section Begin -->
        <?php include_once 'header.php' ?>

        <section>
            <div class="container py-5 ">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-8 col-xl-6">
                        <div class="card border-top border-bottom border-3 shadow" style="border-color: #f37a27 !important;">
                            <form action="hem.php">
                                <div class="card-body p-5">

                                    <p class="lead fw-bold mb-5" style="color: #f37a27;">Retutn Order</p>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <p class="small text-muted mb-1">Date</p>
                                            <p>10 April 2021</p>
                                        </div>
                                        <div class="col mb-3">
                                            <p class="small text-muted mb-1">Order No.</p>
                                            <p>012j1gvs356c</p>
                                        </div>
                                    </div>

                                    <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-9 col-8">
                                                <p>BEATS Solo 3 Wireless Headphones</p>
                                                <div class="row">
                                                    <p class="mb-0 ml-3">RS 454</p>&nbsp;&nbsp;&nbsp;
                                                    <p class="mb-0">QTY 4</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-3 col-4">
                                                <img src="./img/Cake_Magic-removebg-preview.png">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mx-n5 px-5 py-4">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-9">
                                                <p>Reason for return</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-8col-lg-9 my ">
                                                <div class="row pl-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="select" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Refund
                                                        </label>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="select" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Replace
                                                        </label>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-md-4 col-lg-3" id="but">
                                                <button type="button" class="btn btn-primary change">Change</button>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="mx-n5 px-5 py-4">
                                        <div class="row">

                                            <div class="col-md-12 col-lg-12 ">

                                                <!-- <img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40" height="40" /> -->
                                                <label class="comment1">Comment</label>
                                                <div class="form-outline w-100">
                                                    <textarea class="form-control comment" id="textAreaExample" cols="30" rows="4" style="background: #fff;">Message</textarea>
                                                </div>

                                                <!-- <div class="float-end mt-2 pt-1">
                                                <button type="button" class="btn btn-primary btn-sm">Post comment</button>
                                                <button type="r" class="btn btn-outline-primary btn-sm">Cancel</button>
                                            </div> -->
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row my-4 justify-content-center">
                                        <button type="submit" class="site-btn continue" name="insertorder">SUBMIT REQUEST</button>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">



                                        </div>
                                    </div>

                                    <p class="mt-4 pt-2 mb-0">Want any help? <a href="#!" style="color: #f37a27;">Please contact
                                            us</a></p>

                                </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer Section Begin -->
        <?php include_once 'footer.php' ?>
    </body>

    </html>