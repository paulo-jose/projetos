<?php

require("../../config.php");
require("../../model/Acordo.php");
require("../../model/Usuario.php");
require("../../model/Feedback.php");
require('../../src/autenticacao-login.php');

$feedback = new Feedback($mysql);
$msg = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $feedbacks = $feedback->buscarPorData($_SESSION['usuario']['lotacao'], $_POST['data']);

    if (empty($feedbacks))
        $msg = true;
} else
    $feedbacks = $feedback->buscarPorAgencia($_SESSION['usuario']['lotacao']);


for ($i = 0; $i < 10; $i++) {
    $ultimasDatas[] = date('d/m/Y', strtotime('-' . $i . 'days', strtotime('now')));
}


?>

<html>

<head>
    <title>Painel</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">

</head>

<body>




    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #0000CD;">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['usuario']['funcao'] >= 14) :; ?>
                    <li><a href="/acordos/view/pages/painel.php" style="color:white">Home</a></li>
                    <li><a href="/acordos/view/pages/lista-usuario.php" style="color:white">Usuário</a></li>
                    <li><a href="/acordos/admin/index.php" style="color:white">Acordos</a></li>
                <?php else :; ?>
                    <li><a href="/acordos/user/index.php" style="color:white">Acordos</a></li>
                <?php endif; ?>
                <li><a href="/acordos/view/pages/lista-acordo.php" style="color:white">Feedbacks</a></li>
                <li><a href="/acordos/src/logout.php"" class=" login" style="color:white"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
            </div>
        </nav>
    </header>

    <main class="conteudoPrincipal">
        <div class="container">

            <h1>Painel</h1>

            <?php if ($msg) : ?>
                <div class="alert alert-danger" role="alert">
                    Acordos/Feedback não localizado nesta data.
                </div>
            <?php endif; ?>

            <div class="form-group">
                <form id="from" name="from" action="./painel.php" method="post">
                    <label>Data:</label>
                    <select class="form-control" name="data" required onchange="carregar()">
                        <?php for ($i = count($ultimasDatas) - 1; $i >= 0; $i--) : ?>
                            <option selected><?php echo $ultimasDatas[$i] ?></option>
                        <?php endfor; ?>
                        <option selected>Escolha a data</option>
                    </select>
                </form>
            </div>
            <ul class="list-group">
                <li class="list-group-item active">Últimos Acordos</li>
                <?php if (!empty($feedbacks)) : ?>
                    <?php foreach ($feedbacks as $feedback) : ?>
                        <a href="listagem.php?idAcordo=<?php echo $feedback['idAcordo']?>" class="list-group-item list-group-item-action"><?php echo $feedback['titulo'] ?></a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <a href="" class="list-group-item list-group-item-action">Nenhum Acordo localizado.</a>
                <?php endif; ?>
            </ul>


            <ul class="list-group">
                <li class="list-group-item active">Feedbacks do Dia</li>
                <?php if (!empty($feedbacks)) : ?>
                    <?php foreach ($feedbacks as $feedback) : ?>
                        <a href="listagem.php?id=<?php echo $feedback['id']?>" class="list-group-item list-group-item-action"><?php echo $feedback['descrição'] ?></a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <a href="" class="list-group-item list-group-item-action">Nenhum feedback localizado.</a>
                <?php endif; ?>

            </ul>

        </div>

    </main>

    <script>
        function carregar() {
            this.from.submit();
        }
    </script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>