<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$product_id = $handle->secure($_POST['product_id']);
if ($_POST['status'] == 'active') {
    $query = "update product set status='active' where product_id='$product_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-success" onclick="deactive(<?php echo $product_id ?>,'deactive' )">Active</button>
<?php } else {
    $query = "update product set status='deactive' where product_id='$product_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-danger" onclick="active(<?php echo $product_id ?>,'active' )">Dective</button>
<?php } ?>