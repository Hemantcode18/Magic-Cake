<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
include_once 'admin/dbcontroller.php';
$handle = new dbcontroller();
$otp = $handle->secure($_POST['otp']);
if (isset($_POST['submit'])) {


    if ($otp) {
        if ($otp == $_SESSION['otp']) {
            $_SESSION['varify'] = "done";
            $query3 = "insert into login(`username`,`password`,`type`) values('" . $_SESSION['session_id'] . "','" . $_SESSION['password'] . "','user')";
            $result2 = $handle->executequery($query3);
            $query1 = "update registration set status='Login' where registration_id=(select registration_id from registration where email='" . $_SESSION['session_id'] . "')";
            $result = $handle->executequery($query1);
            if ($result and $result2) {
                header('Location:index.php?message=user are successfully Signin');
            }
        } else {
            header('Location:otp.php?message=Please enter correct otp');
        }
    }
} elseif (isset($_POST['ResendOTP'])) {
    echo "hemant";
    $mail = new PHPMailer(true);
    $email = $_SESSION['session_id'];

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hemantbairwa86@gmail.com';                     // SMTP username
        $mail->Password   = 'hembca12318';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('hemantbairwa86@gmail.com', 'Magic Cake');
        $mail->addAddress($email, 'Bairwa Hemant');     // Add a recipient
        $_SESSION['otp'] = rand(111111, 999999);

        $_SESSION['status'] = 'panding';
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "OTP Varification";
        $mail->Body    = "User Email: " . $email . "<br/>" . "OTP is: " . $_SESSION['otp'];
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        header('Location:otp.php');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
