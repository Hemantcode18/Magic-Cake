<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$kg_id = $handle->secure($_POST['kg_id']);
if ($_POST['status'] == 'active') {
    $query = "update product_kg set status='active' where kg_id='$kg_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-success" onclick="deactive(<?php echo $kg_id ?>,'deactive' )">Active</button>
<?php } else {
    $query = "update product_kg set status='deactive' where kg_id='$kg_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-danger" onclick="active(<?php echo $kg_id ?>,'active' )">Dective</button>
<?php } ?>