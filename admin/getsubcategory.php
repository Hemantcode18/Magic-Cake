<?php
if (isset($_POST['cat_id'])) {
    include_once 'dbcontroller.php';
    $handle = new DBcontroller();
    $category_id = $handle->secure($_POST['cat_id']);
    $query = "select * from subcategory where category_id='$category_id' order by subcategory_name ASC";
    $row = $handle->runquery($query);
    $count = $handle->numrows($query);
    if ($count > 0) { ?>

        <option selected>Select Subategory</option>
        <?php foreach ($row as $array) { ?>
            <option value="<?php echo $array['subcategory_id'] ?>"><?php echo $array['subcategory_name'] ?></option>
        <?php }
    } else { ?>
        <option selected>No Subategory Available</option>
<?php  }
} else {
}
