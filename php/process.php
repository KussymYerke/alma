<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();
$mail->SMTPOptions = array(
           'ssl' => array(
               'verify_peer' => false,
               'verify_peer_name' => false,
               'allow_self_signed' => true
           )
       );

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.mail.yahoo.com';  			// Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'kusumerkebulan@gmail.com';                     // SMTP username
    $mail->Password   = '654321-Erke03esppor';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('kussym.almaty@gmail.com');
    $mail->addAddress('kusumerkebulan@gmail.com');     // Add a recipient
    $mail->addReplyTo($_REQUEST['email'], $_REQUEST['name']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_REQUEST['subject'];

    $fields = array();
    $fields{"name"} = "Name";
    $fields{"email"} = "E-mail";
    $fields{"subject"} = "Subject";
    $fields{"message"} = "Message";

    $body = "Here is the message from yourwebsite:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }

    $mail->Body    = $body;
    $mail->AltBody = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
