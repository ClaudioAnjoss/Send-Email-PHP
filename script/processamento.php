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
    header('location: ../index.php?campo=vazio');
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
    $mail->Username   = 'insira aqui um email valido';
    $mail->Password   = 'insira a senha do email';
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

<head>
	<meta charset="utf-8" />
	<title>App Mail Send</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href="../css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="" id="dialog" >

	<div id="email" class="container">

		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="../img/logo.png" alt="" width="72" height="72">
			<h2>Send Mail</h2>
			<p class="lead">Seu app de envio de e-mails particular!</p>
		</div>
        
        <div class="row flipInX">
            <div class="col-md-8">
                <?php if($mensagem->status == 1) { ?>
                    <h1 class="display-4 text-success">Sucesso!</h1>
                    <p class="lead">O e-mail foi enviado com sucesso!</p>
                    <a href="../index.php" class="btn btn-success">Voltar para pagína inicial</a>
                <?php } ?>
                <?php if($mensagem->status == 0) { ?>
                    <h1 class="display-4 text-danger">Ops!!!</h1>
                    <p class="lead">Ocorreu um erro ao enviar o email!</p>
                    <p><?php echo $mensagem->descricao; ?></p>
                    <a href="../index.php" class="btn btn-danger">Voltar e corrigir</a>
                <?php } ?>
            </div>
        </div>

	</div>

</body>

</html>

