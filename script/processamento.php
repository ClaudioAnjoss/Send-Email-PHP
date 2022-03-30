<?php

require '../PHPMailer/Exception.php';
require '../PHPMailer/OAuth.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/POP3.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mensagem {
    private $para = null;
    private $assunto = null;
    private $mensagem = null;

    function __get($value) {
        return $this->$value;
    }

    function __set($attr , $value) {
        $this->$attr = $value;
    }

    function validarMensagem() {
        if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }
        return true;
    }
}

$mensagem = new Mensagem();
$mensagem->__set('para' , $_POST['para']);
$mensagem->__set('assunto' , $_POST['assunto']);
$mensagem->__set('mensagem' , $_POST['mensagem']);

if(!$mensagem->validarMensagem()) {
    echo 'script interrompido por campos vazios';
    die();
} 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\SMTP;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;
    $mail->isSMTP();

    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'estudar2102@gmail.com';
    $mail->Password   = 'estudos2102!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465; 

    //Recipients
    $mail->setFrom('estudar2102@gmail.com', 'Adm');
    $mail->addAddress('estudar2102@gmail.com', 'Usuario');

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Oi eu sou o assunto';
    $mail->Body    = 'Oi eu sou o conteudo</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'mensagem enviada';
} catch (Exception $e) {
    echo "falha ao enviar mensagem Error: {$mail->ErrorInfo}";
}

echo '<pre>';
print_r($mensagem);
echo '</pre>';
