<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$cat_id = $handle->secure($_POST['category_id']);
if ($_POST['status'] == 'active') {
    $query = "update category set status='active' where category_id='$cat_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-success" onclick="deactive(<?php echo $cat_id ?>,'deactive' )">Active</button>
<?php } else {
    $query = "update category set status='deactive' where category_id='$cat_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-danger" onclick="active(<?php echo $cat_id ?>,'active' )">Dective</button>
<?php } ?>