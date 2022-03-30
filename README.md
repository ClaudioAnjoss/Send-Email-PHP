# Send-Email-PHP
Um site simples com o intuito de enviar um e-mail ao destinatario preenchido no formulario feito com o proposito apenas de treino.
O processo de envio de email esta desabilitado pois não ha um usuario logado no client para o envio do email. para funcionar,
dentro do script processamento.php adicione um email e senha nas classes :
$mail->Username   = 'insira aqui um email valido';
$mail->Password   = 'insira a senha do email';
Certifique-se de que sua conta nao irá bloquear o login por segurança.
Feito todas essas verificação o script funcionara corretamente.
