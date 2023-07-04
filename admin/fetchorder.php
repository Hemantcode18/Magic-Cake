   <?php

    include 'dbcontroller.php';
    $handle = new DBcontroller();
    $order_id = $_POST['id'];
    $query = "select addtocart.*,`order`.*,`order_item`.* from `order_item`,addtocart,`order` where order_item.order_id='$order_id' and addtocart.cart_id=order_item.cart_id and order.order_id=order_item.order_id";

    $fetch = $handle->fetchall($query);


    ?>

   <table class="table">
       <div class="see">

       </div>
       <thead>
           <tr>
               <th scope="col">#</th>
               <th scope="col">Product Detail</th>
               <th scope="col">Product Price</th>
               <th scope="col">Qty</th>
               <th scope="col">Total Amount</th>
               <th scope="col">Order Status</th>
           </tr>
       </thead>
       <tbody>
           <?php
            $i = 1;
            foreach ($fetch as $res) { ?>
               <tr>

                   <td><?php echo $i++ ?></td>

                   <td><img src="./productimages/convertimages/RC<?php echo $res['product_image'] ?>" height="70px" width="70px"> <?php echo $res['product_name'] ?></td>
                   <td><?php echo $res['product_price'] ?></td>
                   <td><?php echo $res['product_qty'] ?></td>
                   <td><?php echo $res['product_price'] * $res['product_qty'] ?></td>
                   <td><?php $order_status = $res['or_item_status'] ?>
                       <input type="hidden" class="id" value="<?php echo $res['or_item_id'] ?>">
                       <select class="form-control" onchange="hem(this.value,<?php echo $res['or_item_id'] ?>)">
                           <?php if ($order_status == 'Pending') { ?>
                               <option value="Pending" selected>Pending</option>
                               <option value="Processing">Processing</option>
                               <option value="Complete">Complete</option>
                           <?php } elseif ($order_status == 'Processing') { ?>
                               <option value="Pending">Pending</option>
                               <option value="Processing" selected>Processing</option>
                               <option value="Complete">Complete</option>
                           <?php } else { ?>
                               <option value="Pending">Pending</option>
                               <option value="Processing">Processing</option>
                               <option value="Complete" selected>Complete</option>

                           <?php  } ?>
                       </select>

                   </td>



               </tr>
           <?php }



            ?>
       </tbody>
   </table>
   <script>
       function hem(val, id) {

           var b = "button";
           $.ajax({
               url: 'fetchorder2.php',
               type: "post",
               data: {
                   button: b,
                   value: val,
                   or_item_id: id,

               },

               success: function(data) {

                   $('.see').html(' <div class="alert alert-success">' + data + '</div>');
                   setTimeout(function() {
                       $('.see').fadeOut(' <div class="alert alert-success">' + data + '</div>');
                   }, 2000);


               }
           });
       }
   </script>