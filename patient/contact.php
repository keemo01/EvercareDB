<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 25;

$mail->Username = "dragonfever11@gmail.com";
$mail->Password = "ffagzehafgqegbgc";

$mail->setFrom($email, $name);
$mail->addAddress("dragonfever11@gmail.com", "Akeem");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: /PPIT/Hospital/patient/sent.html");