<?php

require("../../config.php");
require("../../model/Acordo.php");
require("../../model/Feedback.php");
require('../../src/autenticacao-login.php');

$feedback = new Feedback($mysql);
$obj_acordo = new Acordo($mysql);
$acordo['id'] = "";
$acordo['titulo'] = "";
$acordo['descrição'] = "";
$acordo['matricula'] = "";


if (!empty($_GET['id'])) {
    $acordo = $obj_acordo->buscarPorId($_GET['id']);
    $feedbacks = $feedback->buscarPorIdAcordo($_GET['id']);
} else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
        $idAcordo = $_POST['idAcordo'];
        print_r($_POST['id']);
        $feedback->remover($_POST['id']);
        header('Location: lista-feedback.php?id=' . $idAcordo);
    }
}

?>

<html>

<head>
    <title>Edição</title>
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
                <?php if ($_SESSION['usuario']['funcao'] >= '14') :; ?>
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
            <div class="form-group">
                <h1>Listagem dos Feedback</h1>
            </div>
            <form id="from" name="from" action="lista-feedback.php" method="post">

                <?php if (empty($feedbacks)) : ?>
                    <div class="alert alert-warning" role="alert">
                        Nenhum Feedback localizado..
                    </div>

                <?php else : ?>
                    <form id="from" name="from" action="lista-feedback.php" method="post">
                        <?php foreach ($feedbacks as $feedback) : ?>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $feedback['id']; ?>" />
                                <input type="hidden" name="idAcordo" value="<?php echo $feedback['idAcordo']; ?>" />
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Feedback do acordo:<strong> <?php echo $acordo['titulo'] ?></strong></h5>
                                            <small><p class="text-right">Data: <?php echo $feedback['data'] ?></p></small>
                                        </div>
                                        <div class="form-group">
                                            <p class="mb-1"><?php echo $feedback['descrição'] ?></p>
                                        </div>
                                        <div class="from-control">
                                            <small>Criado por: <?php echo $feedback['usuario']?></small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </form>
        </div>
    </main>
    
    <!-- <footer class="footer" style="background: #0000CD">
        <div class="container text-center">
            <small style="color: white"> Desenvolvido por: Paulo José de Sousa</br></small>
            <small style="color: white">Matrícula: c138255-8</small>
        </div>
    </footer> -->
</body>

</html>