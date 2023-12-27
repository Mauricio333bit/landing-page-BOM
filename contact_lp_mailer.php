<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

function createMail($sender, $message)
{
    $mail = new PHPMailer(true);

    // Server settings for access to the sender account
    $mail->SMTPDebug = 0; // debug output
    $mail->isSMTP(); // protocol that will be used for sending
    $mail->Host = 'smtp.gmail.com'; // Set SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'businessonmovenoreply@gmail.com'; // SMTP user Gmail account
    $mail->Password = 'pbin dfqk tvkt cnje';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients and sending
    $mail->setFrom($sender, 'Business On Move');

    $mail->addReplyTo('businessonmovenoreply@gmail.com', 'Reply Information');

    // Attachments  

    //$mail->addAttachment('images/iesLogo.png'); //attach files

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Customer Support';
    $mail->Body = $message;

    return $mail;
}

function makeMessageUser(string $nameUsr)
{
    $message = "<p>Hi <b><i>$nameUsr</i></b>!</p> 

    <p>Thank you for contacting <u>Business On Move</u>. We value your time and appreciate your interest in our services.</p>
    
    <p>Within the next few hours, one of our representatives will discuss your needs in depth to provide the necessary advice on our products and services.</p>
    
    <p>Thank you for your interest for us!</p>
    
    <p>Regards</p>
    
    <p><b>Juan Cruz Rios</b><br>
    <i>Business On Move</i></p>";
    return $message;
}







function makeMessageSupportBOM(string $nameUsr, string $usr_email)
{
    $message =
        "<p>This user <span style='color: blue;'><b>$nameUsr</b></span> wants to contact us through the website. Here are their details:</p>

    <p>Email: <a href='mailto:$usr_email' style='color: green;'><u>$usr_email</u></a></p>";

    return $message;
}









function sendEmail($mail, $addressee)
{
    try {
        $mail->addAddress($addressee);
        $mail->send();
        header("location:index.html");
    } catch (Exception $e) {
        echo "Could not send message. Mailer Error: {$mail->ErrorInfo}";
    }
}

//take data
$fullname = $_POST['fullname'];
$usr_email = $_POST['email'];


$contactEmailUser = createMail('businessonmovenoreply@gmail.com', makeMessageUser($fullname));
$contactEmailSupportBOM = createMail('businessonmovenoreply@gmail.com', makeMessageSupportBOM($fullname, $usr_email));


if (filter_var($usr_email, FILTER_VALIDATE_EMAIL)) {

    sendEmail($contactEmailUser, $usr_email);
    sendEmail($contactEmailSupportBOM, 'info@business.com');

    exit();
} else {
    echo "The provided address is invalid";
}
