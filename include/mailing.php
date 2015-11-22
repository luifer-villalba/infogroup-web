<?php
/**
 * This example shows settings to use when sending via Google"s Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don"t have access to that
date_default_timezone_set("America/Asuncion");

require "class.phpmailer.php";
require "class.smtp.php";

$allowed = ["sansui.com.py", "4qstudios.com.py", "infogroup.com.py"];

$to = $_POST["to"];
$reply = $_POST["reply"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$referer = $_POST["referer"];

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
//$mail->Debugoutput = "html";

//Set the hostname of the mail server
$mail->Host = "smtp.zoho.com";

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = "tls";

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "webmaster@4qstudios.com.py";

//Password to use for SMTP authentication
$mail->Password = "4qmaurfje8xe";

//Set who the message is to be sent from
$mail->setFrom("mailing@infogroup.com.py", "Consulta web");

//Set an alternative reply-to address
$mail->addReplyTo($reply);

//Set who the message is to be sent to
$mail->addAddress($to);

//Set the subject line
$mail->Subject = $subject;

$mail->isHTML();
$mail->Body = $message;

if (in_array($referer, $allowed)) {
//send the message, check for errors
    if (!$mail->send()) {
        echo "false";
//        echo $mail->ErrorInfo;
	error_log($mail->ErrorInfo);
    } else {
        echo "true";
    }
}else{
    echo "false";
    error_log("ocurrio un error al enviar mail");
}
