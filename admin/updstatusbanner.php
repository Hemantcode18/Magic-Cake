<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$banner_id = $handle->secure($_POST['banner_id']);
if ($_POST['status'] == 'active') {
    $query = "update banner set status='active' where banner_id='$banner_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-success" onclick="deactive(<?php echo $banner_id ?>,'deactive' )">Active</button>
<?php } else {
    $query = "update banner set status='deactive' where banner_id='$banner_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-danger" onclick="active(<?php echo $banner_id ?>,'active' )">Dective</button>
<?php } ?>