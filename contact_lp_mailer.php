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
    $mail->Username = 'Businessonmovenoreply@gmail.com'; // SMTP user Gmail account
    $mail->Password = 'pbin dfqk tvkt cnje';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients and sending
    $mail->setFrom($sender, 'Bussines On The Move');
    $mail->addReplyTo('info@businessonmove.com', 'Reply Information');

    // Attachments  

    //$mail->addAttachment('images/iesLogo.png'); //attach files

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Customer Support';
    #$mail->Body = $message;

    $mail->Body = `<div style="width:500px; min-height:400px; margin:0 auto; background-color:#112724; color:white; font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif; padding:40px">
    <img height="32" src="https://cdn.discordapp.com/attachments/695395214264762433/882325678685556756/g.png" alt="GeoBox">
        <div style="text-align:center; margin-top: 20px;">
        <div style="font-weight:bold; font-size:24px; margin-bottom: 10px; margin-top: 50px;">`+ "Hola " + usuariosParaEnviar[cantidad].NombreUsuario + `</div>
            <div style="font-size:20px;">Hay nuevos cambios en el Campo: `+ campo.NombreCampo + `</div>
            <div style="font-size:20px;">`+ newMessage + `</div>
            <button style="background-color: #2a9d8f; color: #f2f2f2; padding: 10px 50px; border: none; font-weight: bold; font-size: 20px; text-decoration: none; font-weight: bold; border-radius: 5px; cursor: pointer; word-break: break-word; margin-top: 60px;">
                Ver en GeoBox
            </button>
        </div>
    </div>`

    return $mail;
}



function makeMessageUser(string $nameUsr)
{
    $message = "This user $nameUsr was contact us

  Thank you for contacting Business On Move. We value your time and appreciate your interest in our services. 
  Within the next few hours, one of our representatives will discuss your needs in depth to provide the necessary advice on our products and services. 
  
  Thank you for your interest for us!
  
  Regards,
  
  Juan Cruz Rios
  Business On Move";
    return $message;
}


function makeMessageSupportBOM(string $nameUsr, string $usr_email, string $usr_phone)
{
    $message = "This user $nameUsr wants to contact us through the website. Here are their details:

    Phone: $usr_phone
    Email: $usr_email";
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

$contactEmail = createMail("Businessonmovenoreply@gmail.com", makeMessageUser($fullname));

if (filter_var($usr_email, FILTER_VALIDATE_EMAIL)) {

    sendEmail($contactEmail, $usr_email);

    exit();
} else {
    echo "La dirección de correo no es válida.";
}
