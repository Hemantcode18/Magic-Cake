  <!DOCTYPE html>
  <html lang="zxx">

  <head>
      <?php include_once 'head.php' ?>

  </head>

  <style>
      #style4,
      li {
          color: #fd7e14;
      }

      #style4:hover {
          color: black;
      }





      #container1 {
          position: relative;
          width: 100%;
          max-width: 400px;
      }

      #container1 img {
          width: 70%;
          height: auto;
      }

      #container1 .btn {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          background-color: #555;
          color: white;
          font-size: 16px;
          padding: 12px 24px;
          border: none;

          cursor: pointer;
          border-radius: 5px;
          text-align: center;
          background-color: rgba(0, 0, 0, 0.1);


      }

      #container1 .btn:hover {
          background-color: rgba(0, 0, 0, 0.3);

      }
  </style>

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

      <div class="container-fluid py-3">
          <div class="row">
              <div class="col">
                  <nav aria-label="breadcrumb" class="bg-white rounded-3 p-3 mb-4">
                      <ol class="breadcrumb mb-0">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                          <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                      </ol>
                  </nav>
              </div>
          </div>

          <div class="row">

              <?php
                include 'profilesidebar.php';
                // include './admin/dbcontroller.php';
                // $handle = new DBcontroller();
                $query = "select * from `order` where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "')";
                $res = $handle->fetchall($query);


                ?>
              <div class="col-lg-9 col-md-9 col-sm-9">
                  <div class="section-title">

                      <center>
                          <!-- <h3>Order</h3></br> -->
                          <a> <span>
                                  View Order
                              </span></a>
                      </center>
                  </div>
                  <div class="table-responsive">
                      <table class="table table-bordered mt-5">
                          <thead>
                              <tr>
                                  <th scope="col">id</th>
                                  <th scope="col">Product Detail</th>
                                  <th scope="col">price</th>
                                  <th scope="col">qty</th>
                                  <th scope="col">Total</th>
                                  <th scope="col">Date Time</th>

                                  <th>Return Order</th>
                                  <th>Cancel Order</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                $i = 1;
                                foreach ($res as $row2) {
                                    $query = "select addtocart.*,`order`.*,`order_item`.* from addtocart,`order`,`order_item` where addtocart.product_id=`order_item`.product_id and `order`.order_id='" . $row2['order_id'] . "' and `order_item`.order_id='" . $row2['order_id'] . "' and addtocart.registration_id='" . $row2['registration_id'] . "' and addtocart.cart_id=`order_item`.cart_id";


                                    $res2 = $handle->fetchall($query);

                                    $count = count($res2);
                                    $i = 1;
                                    foreach ($res2 as $row) {
                                        $order_status = $row['or_item_status'];
                                ?>
                                      <tr>
                                          <?php if ($i == 1) { ?>
                                              <td rowspan="<?php echo $count ?>"><?php echo $row['order_id'] ?></td>

                                          <?php
                                                $i++;
                                            } ?>
                                          <td>
                                              <img src="./admin/productimages/convertimages/RC<?php echo $row['product_image'] ?>" height="60px" width="60px"><br>
                                              <?php echo $row['product_name'] ?>
                                          </td>
                                          <td><?php echo $row['product_price'] ?></td>
                                          <td><?php echo $row['product_qty'] ?></td>
                                          <td><?php echo $row['product_price'] * $row['product_qty'] ?></td>
                                          <td><?php echo date('d-m-y h:i:s A', strtotime($row['date_time'])); ?>
                                          </td>

                                          <?php if ($order_status == 'Cancelled' || $order_status == 'Return' || $order_status == 'Pending' || $order_status == 'Processing' || $order_status == NULL) { ?>
                                              <td class="invert">
                                                  <h5>Order is not procced to return.</h5>
                                              </td>
                                          <?php } else { ?>
                                              <td class="invert">
                                                  <a href="javascript:void(0);" onclick="return confirmdata1('<?php echo $order_id; ?>');">
                                                      Return Order
                                                  </a>
                                              </td>
                                          <?php }  ?>
                                          <?php if ($order_status == 'Return' || $order_status == 'Pending' || $order_status == 'Processing' || $order_status == NULL) { ?>
                                              <td class="invert">
                                                  <h5>You do not proceed to delete this order.</h5>
                                              </td>
                                          <?php } else { ?>
                                              <td class="invert">
                                                  <center> <a href="javascript:void(0);" onclick="return confirmdata('<?php echo $order_id; ?>');">
                                                          <div class="rem">
                                                              <i style="color:black" class="fa fa-close"></i>
                                                          </div>
                                                      </a></center>
                                              </td>
                                          <?php } ?>
                                      </tr>
                              <?php
                                    }
                                } ?>

                          </tbody>
                      </table>
                  </div>

              </div>
          </div>
      </div>


      <!-- Instagram Section Begin -->

      <!-- Instagram Section End -->



      <!-- Footer Section Begin -->
      <?php include_once 'footer.php' ?>
  </body>

  </html>