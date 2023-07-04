<?php
$path = "./admin/images/";

if ($_FILES['image']['name'] != '') {
    session_start();
    include './admin/dbcontroller.php';
    $handle = new DBcontroller();
    $image1 = rand(111111111, 999999999) . $_FILES['image']['name'];
    if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
        echo 'Please select only JPG,JPEG and PNG file ';
    } else {

        move_uploaded_file($_FILES['image']['tmp_name'], $path . $image1);

        $query = "update registration set image='$image1' where email='" . $_SESSION['session_id'] . "'";
        $res = $handle->executequery($query);
        if ($res) {
            header('Location:vieworder.php');
        }
    }
} else {
?>
    <script>
        history.back();
    </script>
<?php
}
