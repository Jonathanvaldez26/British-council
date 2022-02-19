<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");
require dirname(__DIR__).'/../public/librerias/PHPMailer/Exception.php';
require dirname(__DIR__).'/../public/librerias/PHPMailer/PHPMailer.php';
require dirname(__DIR__).'/../public/librerias/PHPMailer/SMTP.php';

use \Core\MasterDom;
use \Core\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 

class Mailer{
  

    private $_contenedor;

    function __construct(){
        //parent::__construct();
    }


    public function mailer($data) {
        $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'pruebass345@gmail.com';                     //SMTP username
    $mail->Password   = 'pru3b@5_123';                               //SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAutoTLS = false;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('pruebass345@gmail.com', 'BC');
    $mail->addAddress($data['nombre'], $data['nombre']);     //Add a recipient

    $url = explode('/', $data['ruta_constancia'] );
    $ruta_constancia = $url['1']."/".$url['2'];


    $message = "<h5>Dear ".$data['nombre']."</h5><br>";
    $message .= "Your certificate has been sent<br>";
    
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->AddAttachment($ruta_constancia);
    $mail->Subject = 'Certificate '.$data['nombre_constancia'];
    $mail->Body    = $message;
    

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "No se pudo enviar el email: {$mail->ErrorInfo}";
}

    }


    public function mailerValidateData($data) {
        $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'pruebass345@gmail.com';                     //SMTP username
    $mail->Password   = 'pru3b@5_123';                               //SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAutoTLS = false;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('pruebass345@gmail.com', 'Gerson');
    $mail->addAddress('gvelasco_08@hotmail.com', 'Ger');     //Add a recipient

    $message = "<h5>Dear <b>Administrator</b></h5><br>";
    $message .= "The user ".$data['usuario']."<br>";
    $message .= "has requested his change of information with the following data <br>";
    $message .= "Name : <b>".$data['nombre']."</b><br>";
    $message .= "Surname : <b>".$data['apellido_m']."</b><br>";
    $message .= "Second Surname : <b>".$data['apellido_p']."</b><br>";
    
    
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Data verification '.$data['nombre'].' '.$data['apellido_p'].' '.$data['apellido_m'];
    $mail->Body = $message;
    

    if($mail->send()){
        echo 'El mensaje ha sido enviado';
    }
    //mail->send();
    
} catch (Exception $e) {
    echo "No se pudo enviar el email: {$mail->ErrorInfo}";
}

    }

}

