<?php 
    require 'processamento.php';
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
        <?php if($mensagem->status) { ?>
            <h1><? $mensagem->descricao ?></h1>
        <?php $mensagem->status = false; } ?>

        <?php if($mensagem->status) { ?>
            <h1><? $mensagem->descricao ?></h1>
        <?php } ?>
    </div>
</body>

</html>