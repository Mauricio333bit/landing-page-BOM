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
    $message = "<div style='width:800px; min-height:400px; margin:0 auto; background-color:#205283; color:white; font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif; padding:40px'>
    <img height='100' src='https://cdn.discordapp.com/attachments/482361276337750036/1191878762871140362/logo-bom.jpg?ex=65a70a99&is=65949599&hm=f0f68b38a28f336d57bba7a1fcb9e7516bca598a512bd15c4c574f187385ed2f&' alt='Bom'>
        <div style='text-align:center; margin-top: 20px;'>
        <div style='font-weight:bold; font-size:24px; margin-bottom: 10px; margin-top: 50px;'>Hi $nameUsr </div>
            <div style='font-size:20px;'>Thank you for contacting <u>Business On Move</u>. We value your time and appreciate your interest in our services.</div>
            <p></p>
            <div style='font-size:20px;'>Within the next few hours, one of our representatives will discuss your needs in depth to provide the necessary advice on our products and services.</div>
            <p></p>
            <div style='font-size:20px;'>Thank you for your interest for us!</div>
            <p></p>
            <div style='font-size:20px;'>Regards</div>
            <a href='http://businessonmove.com' target='_blank'>
                <button style='background-color: #4499eb; color: #f2f2f2; padding: 10px 50px; border: none; font-weight: bold; font-size: 20px; text-decoration: none; font-weight: bold; border-radius: 5px; cursor: pointer; word-break: break-word; margin-top: 60px;'>
                    Business On Move
                </button>
            </a>
        </div>
    </div>";
    return $message;
}


function makeMessageSupportBOM(string $nameUsr, string $usr_email, string $usr_phone)
{
    $message = "<div style='width:800px; min-height:200px; margin:0 auto; background-color:#205283; color:white; font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif; padding:40px'>
    <img height='100' src='https://cdn.discordapp.com/attachments/482361276337750036/1191878762871140362/logo-bom.jpg?ex=65a70a99&is=65949599&hm=f0f68b38a28f336d57bba7a1fcb9e7516bca598a512bd15c4c574f187385ed2f&' alt='Bom'>
        <div style='text-align:center; margin-top: 20px;'>
            <div style='font-size:20px;'>This user $nameUsr wants to contact us through the website. Here are their details:</div>
            <p></p>
            <div style='font-size:20px;'>Email: $usr_email</div>
            <p></p>
            <div style='font-size:20px;'>Phone: $usr_phone</div>
        </div>
    </div>";
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
$usr_phone = $_POST['phone'];

$contactEmailUser = createMail('businessonmovenoreply@gmail.com', makeMessageUser($fullname));
$contactEmailSupportBOM = createMail('businessonmovenoreply@gmail.com', makeMessageSupportBOM($fullname, $usr_email, $usr_phone));


if (filter_var($usr_email, FILTER_VALIDATE_EMAIL)) {

    sendEmail($contactEmailUser, $usr_email);
    sendEmail($contactEmailSupportBOM, 'info@business.com');

    exit();
} else {
    echo "The provided address is invalid";
}
