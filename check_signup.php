<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

if (isset($_POST['submitsignup'])) {

    include_once 'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $first_name = $handle->secure($_POST['fname']);

    $last_name = $handle->secure($_POST['lname']);
    $email = $handle->secure($_POST['email']);
    $address = $handle->secure($_POST['address']);
    $password = $handle->secure($_POST['password']);
    $confirm_password = $handle->secure($_POST['confirmpassword']);
    $gender = $handle->secure($_POST['gender']);
    $phone_no = $handle->secure($_POST['phone_no']);
    $country = $handle->secure($_POST['country']);
    $state = $handle->secure($_POST['state']);
    $city = $handle->secure($_POST['city']);
    if (isset($_POST['image'])) {

        $image1 = $handle->secure($_POST['image']);
    }

    $new_password = md5($password);
    $query = "select * from registration where email='$email' and phone_no='$phone_no'";
    $count = $handle->numrows($query);
    if ($count > 0) {
        header('Location:signup.php?message=user already exist please signin');
    } else {
        if (isset($_POST['image'])) {
            $path = "admin/images/";
            if ($_FILES['image']['name'] != '') {
                $image1 = rand(111111111, 999999999) . $_FILES['image']['name'];
                if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
                    header('Location:index.php?message=Please select only JPG,JPEG and PNG file ');
                } else {

                    move_uploaded_file($_FILES['image']['tmp_name'], $path . $image1);
                }
            }
        } else {
            $image1 = "";
        }


        $query2 = "insert into registration(`first_name`,`last_name`,`email`,`phone_no`,`gender`,`city`,`state`,`country`,`password`,`address`,`image`,`status`) values('$first_name','$last_name','$email','$phone_no','$gender','$city','$state','$country','$new_password','$address','$image1','Register')";
        $result = $handle->executequery($query2);

        // $query3 = "insert into login(`username`,`password`,`type`) values('$email','$new_password','user')";
        // $result2 = $handle->executequery($query3);
        if ($result) {
            session_start();
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'hemantbairwa86@gmail.com';                     // SMTP username
                $mail->Password   = 'kphwfztafvzxmcug';                               // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('hemantbairwa86@gmail.com', 'Magic Cake');
                $mail->addAddress($email, 'Bairwa Hemant');     // Add a recipient
                $_SESSION['otp'] = rand(111111, 999999);
                $_SESSION['session_id'] = $email;
                $_SESSION['status'] = 'panding';
                $_SESSION['password'] = $new_password;
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $first_name;
                $mail->Body    = "User Email: " . $email . "<br/>" . "OTP is: " . $_SESSION['otp'];
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('Location:otp.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
