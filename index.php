<html>

<head>
	<meta charset="utf-8" />
	<title>App Mail Send</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="zoomIn">

	<div id="email" class="container">

		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="img/logo.png" alt="" width="72" height="72">
			<h2>Send Mail</h2>
			<p class="lead">Seu app de envio de e-mails particular!</p>
		</div>

		<div class="row">
			<div class="col-md-8">

				<div class="card-body font-weight-bold">
					<form action="script/processamento.php" method="post">
						<div class="input-group input-group-lg">

							<input name="para" type="email" class="form-control" id="para" placeholder="Digite o e-mail">


							<div class="input-group-append">
								<span class="input-group-text"><i class="fa-solid fa-envelope ml-1"></i></span>
							</div>

						</div>

						<div class="input-group input-group-lg mt-5">

							<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">

							<div class="input-group-append">
								<span class="input-group-text"><i class="fa-solid fa-comment-dots"></i></span>
							</div>

						</div>

						<div class="input-group input-group-lg mt-5 mb-5">

							<textarea name="mensagem" class="form-control" id="mensagem" placeholder="Digite aqui sua mensagem"></textarea>

							<div class="input-group-append">
								<span class="input-group-text">
									<i class="fa-solid fa-message"></i>
								</span>
							</div>

						</div>

						<?php
						if (isset($_GET['campo']) && $_GET['campo'] == 'vazio') {
						?>
							<p class="text-danger">
							Existem campos obrigatórios a serem preenchidos.
							</p>
						<?php } ?>

						<button type="submit" class="btn btn-primary btn-lg btn-block">Enviar Mensagem</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>