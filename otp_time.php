<?php

$i = 60;
$i = $i - $_POST['count'];
if ($_POST['count'] >= 50 and $_POST['count'] <= 60) {
    echo "<p style='font-weight:bolder; color:red'>" . $i . " SECOND</p>";
} elseif ($i < 0) {
    echo "<p style='color:red'>OTP will be expite ,Please resend OTP</p>";
    session_start();
    $_SESSION['otpforget'] = "";
} else {
    echo "$i SECOND ";
}
