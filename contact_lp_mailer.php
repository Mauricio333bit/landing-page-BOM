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
    $mail->Username = 'lavalleies9024@gmail.com'; // SMTP user Gmail account
    $mail->Password = 'cdbv xmcu rxyw odfr';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients and sending
    $mail->setFrom($sender, 'Bussines On The Move');
    // $mail->addAddress('lavalleies9024@gmail.com', 'Troll'); // Receiver Email, name is optional
    $mail->addReplyTo('lavalleies9024@gmail.com', 'Reply Information');

    // Attachments  

    //$mail->addAttachment('images/iesLogo.png'); //attach files

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Customer Support';
    $mail->Body = $message;

    return $mail;
}



function makeMessage(string $nameUsr)
{
    $message = "Hi $nameUsr,

  Thank you for contacting Business On The Move. We have received your email and a member of our support team will contact you shortly. We value your time and appreciate your interest in our services, and understand you have specific questions and requirements. That's why we pride ourselves on providing an immediate response. Within the next few hours, one of our representatives will discuss your needs in depth to provide the necessary advice on our products and services. We hope to support you in meeting your business goals and establishing a valuable relationship for both parties. We look forward to speaking with you! Thank you again for your interest in Business On The Move!
  
  Best regards,
  
  [rep name]
  Business On The Move";
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


$contactEmail = createMail("lavalleies9024@gmail.com", makeMessage($fullname));

if (filter_var($usr_email, FILTER_VALIDATE_EMAIL)) {

    sendEmail($contactEmail, $usr_email);

    exit();
} else {
    echo "La dirección de correo no es válida.";
}
