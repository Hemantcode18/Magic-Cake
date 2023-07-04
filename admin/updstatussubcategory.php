<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$cat_id = $handle->secure($_POST['subcategory_id']);
if ($_POST['status'] == 'active') {
    $query = "update subcategory set status='active' where subcategory_id='$cat_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-success" onclick="deactive(<?php echo $cat_id ?>,'deactive' )">Active</button>
<?php } else {
    $query = "update subcategory set status='deactive' where subcategory_id='$cat_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-danger" onclick="active(<?php echo $cat_id ?>,'active' )">Dective</button>
<?php } ?>