   <?php
    include_once './dbcontroller.php';
    $handle = new DBcontroller();
    $search = $_POST['search'];
    // $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id and category.category_name like '%$search%'";
    // $count = $handle->numrows($query);
    if (!empty($_POST['search'])) {
        $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id and subcategory.subcategory_name like '%$search%'  ";
        $count = $handle->numrows($query);
        if ($count == 0) {
            $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id and product.product_name like '%$search%'";
            $countproduct = $handle->numrows($query);
            if ($countproduct == 0) {
                $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id and category.category_name like '%$search%'";
            }
        }
    } else {
        $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id order by product.product_id desc limit 1,5";
    }

    $row = $handle->runquery($query);
    $path = "productimages/convertimages/RC";


    ?>

   <div class="table-responsive pt-3" id="tbody">
       <table class="table table-bordered">
           <thead class="text-white" style="background-color:#4B49AC;">
               <tr>
                   <th>
                       #
                   </th>
                   <th>
                       Category name
                   </th>
                   <th>
                       Subcategory name
                   </th>
                   <th>
                       Product name
                   </th>
                   <th>
                       Image 1
                   </th>
                   <th>
                       Image 2
                   </th>
                   <th>
                       Image 3
                   </th>
                   <th>
                       Price
                   </th>
                   <th>
                       Qty
                   </th>

                   <th>
                       Status
                   </th>
                   <th>
                       Action
                   </th>
               </tr>
           </thead>
           <?php if (!empty($row)) {
            ?>
               <tbody>
                   <?php
                    $sum = 0;

                    foreach ($row as $array) {
                    ?>
                       <tr>
                           <td>
                               <?php echo $sum = $sum + 1; ?>
                           </td>
                           <td>
                               <?php echo $array['category_name']
                                ?>
                           </td>
                           <td>
                               <?php echo $array['subcategory_name'] ?>
                           </td>
                           <td>
                               <?php echo $array['product_name'] ?>
                           </td>

                           <td class="p-1">
                               <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image1'] ?>"> </center>
                           </td>
                           <td class="p-1">
                               <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image2'] ?>"> </center>
                           </td>
                           <td class="p-1">
                               <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image3'] ?>"> </center>
                           </td>

                           <td>
                               <i class="fa fa-inr"> </i> <?php echo $array['price'] ?>
                           </td>
                           <td>
                               <?php echo $array['qty'] ?>
                           </td>

                           <?php if ($array['status'] == 'deactive') { ?>
                               <td id="status_<?php echo $array['product_id'] ?>"> <button class="btn btn-danger" onclick="active(<?php echo $array['product_id'] ?>,'active')">Deactive</button></td>

                           <?php } else { ?>
                               <td id="status_<?php echo $array['product_id'] ?>"> <button class="btn btn-success" onclick="deactive(<?php echo $array['product_id'] ?>,'deactive')">Active</button></td>

                           <?php } ?>

                           <td>


                               <button onclick="return confirmdata(<?php echo $array['product_id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                               <a href="editproduct.php?product_id=<?php echo $array['product_id'] ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>


                           </td>
                       </tr>
                   <?php } ?>
               </tbody>
           <?php } ?>
       </table>
   </div>