<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if( $_POST['template-contactform-name'] != '' AND $_POST['template-contactform-email'] != '' AND $_POST['template-contactform-message'] != '' ) {

        $name = $_POST['template-contactform-name'];
        $email = $_POST['template-contactform-email'];
        $phone = $_POST['template-contactform-phone'];
        $service = $_POST['template-contactform-service'];
        $subject = $_POST['template-contactform-subject'];
        $message = $_POST['template-contactform-message'];

        $subject = isset($subject) ? $subject : 'New Message From Contact Form';

        $botcheck = $_POST['template-contactform-botcheck'];

        $toemail = 'info@infogroup.com.py'; // Your Email Address
        $toname = 'Victor Scarone'; // Your Name

        if( $botcheck == '' ) {


            $name = isset($name) ? "Nombre: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $phone = isset($phone) ? "Tel: $phone<br><br>" : '';
            $service = isset($service) ? "Servicio: $service<br><br>" : '';
            $message = isset($message) ? "Mensaje: $message<br><br>" : '';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Escrito desde: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $phone $service $message $referrer";

//            $mail->MsgHTML( $body );
            $sendEmail = sendmail($toemail, $subject, $body, "hello");

            if( $sendEmail == true ):
                echo 'Hemos recibido <strong>exitosamente</strong> su mensaje y le estaremos contestando los mas pronto posible.';
            else:
                echo 'Email <strong>no pudo</strong> ser enviado debido a un inesperado error. Por favor intentar mas adelante.<br /><br /><strong>Consultas al:</strong><br />' . $toemail . '';
            endif;
        } else {
            echo 'Bot <strong>detectado</strong>.';
        }
    } else {
        echo 'Por favor <strong>rellene</strong> todos los campos y vuelva a intentarlo.';
    }
} else {
    echo 'Un <strong>error inesperado</strong> ha ocurrido. Por favor intentarlo nuevamente.';
}


function sendmail($to, $subject, $message, $reply)
{

    $url = "https://infogroup.com.py/include/mailing.php";
    $data = array("to" => $to,
        "subject" => $subject,
        "message" => $message,
        "reply" => $reply,
        "referer" => "infogroup.com.py");
    $options = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($data),
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;

}
