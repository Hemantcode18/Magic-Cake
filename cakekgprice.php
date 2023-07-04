 <?php
    if (isset($_POST['kg_id']) and isset($_POST['price'])) {
        include_once 'admin/dbcontroller.php';
        $handle = new DBcontroller();

        $kg_id = $handle->secure($_POST['kg_id']);
        $price = $handle->secure($_POST['price']);
        $query = "select * from product_kg where kg_id='$kg_id' and cake_price='$price'";
        $result = $handle->fetchresult($query);


    ?>
     <h4><?php echo $result['product_rename'] ?></h4>

     <h5 id=""><i class="fa fa-inr"></i> <?php echo $result['cake_price'] ?></h5>

     <input type="hidden" value="<?php echo $result['product_rename'] ?>" name="product_rename" id="product_rename">

     <input type="hidden" value=" <?php echo $result['cake_price'] ?>" name="price2" id="price2">
 <?php } ?>	