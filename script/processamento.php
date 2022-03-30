<?php

require '../PHPMailer/Exception.php';
require '../PHPMailer/OAuth.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/POP3.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mensagem
{
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
    public $status = null;
    public $descricao = null;

    function __get($value)
    {
        return $this->$value;
    }

    function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    function validarMensagem()
    {
        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }
        return true;
    }
}

$mensagem = new Mensagem();
$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);

if (!$mensagem->validarMensagem()) {
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
    $mail->setFrom('estudar2102@gmail.com', 'Send-Email - O seu aplicativo de e-mail');
    $mail->addAddress($mensagem->__get('para'));



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body    = $mensagem->__get('mensagem');
    $mail->AltBody = 'Para visualizar a mensagem é necessario um client que suporte HTML';

    $mail->send();
    $mensagem->status = 1;
} catch (Exception $e) {
    $mensagem->status = 0;
    $mensagem->descricao = "falha ao enviar mensagem Error: {$mail->ErrorInfo}";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Mail Send</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php if($mensagem->status == 1) { ?>
            <h1>Sucesso ao enviar email</h1>
        <?php } ?>

        <?php if($mensagem->status == 0) { ?>
            <h1>Falha ao enviar email</h1>
            <p><?php echo $mensagem->descricao; ?></p>
        <?php } ?>
    </div>
</body>

</html>

