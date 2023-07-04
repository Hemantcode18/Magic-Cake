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
        if ($otp == $_SESSION['otpforget']) {
            // $_SESSION['varify'] = "done";

            header('Location:createpass.php');
        } else {
            header('Location:otpforget.php?message=Please enter correct otp');
        }
    }
} elseif (isset($_POST['ResendOTP'])) {
    // echo "hemant";
    $mail = new PHPMailer(true);
    session_start();
    $email = $_SESSION['email'];
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hemantbairwa86@gmail.com';                     // SMTP username
        $mail->Password   = 'egviibtkszwgkjlg';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('hemantbairwa86@gmail.com', 'Magic Cake');
        $mail->addAddress($email, 'Bairwa Hemant');     // Add a recipient
        $_SESSION['info'] = "Check your mail to forget password";
        $_SESSION['otpforget'] = rand(111111, 999999);
        $otp = $_SESSION['otpforget'];
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Password Reset";
        $mail->Body    = " Hi," . $name . "</br> Click here too reset your password http://localhost/magic_cake/createforgetpass.php<br> OTP is: " . $otp;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        header('Location:otpforget.php');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
