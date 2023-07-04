<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$review_id = $handle->secure($_POST['review_id']);
if ($_POST['status'] == 'active') {
    $query = "update review set status='show' where review_id='$review_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-success" onclick="deactive(<?php echo $review_id ?>,'deactive' )">Show</button>
<?php } else {
    $query = "update review set status='hide' where review_id='$review_id'";
    $result = $handle->executequery($query);
?>
    <button class="btn btn-danger" onclick="active(<?php echo $review_id ?>,'active' )">Hide</button>
<?php } ?>