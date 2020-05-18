<!DOCTYPE html>
<html lang="pt-br">

<?php

include '../../model/Acordo.php';
require '../../config.php';
require('../../src/autenticacao-login.php');

$acordos = new Acordo($mysql);
$matricula = $_SESSION['usuario']['matricula'];

if (!empty($_GET['id'])) {

    $acordos->remover($_GET['id']);
}

if ($_SESSION['usuario']['funcao'] == "14")
    $acordos = $acordos->exibirPorAgencia($_SESSION['usuario']['lotacao']);
else
    $acordos = $acordos->buscarPorMatricula($matricula);

if (!empty($acordos)) {
    $result = null;
    foreach ($acordos as $acordo) {
        if ($acordo['status'] == "Aceito")
            $result[] = $acordo;
    }

    $acordos = $result;
}

?>

<head>
    <title>Feedback</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../view/css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../../view/css/fontawesome.mim.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #0000CD;">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['usuario']['funcao'] >= "14") :; ?>
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

            <h1>Feedback </h1>

            <?php if (isset($_GET['msg'])) : ?>
                <?php if (($_GET['msg'])) : ?>
                    <div class="alert alert-success" role="alert">
                        Feedback cadastrado com sucesso!!
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Feedback não pode ser cadastrado!!
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (empty($acordos)) : ?>
                <div class="alert alert-warning" role="alert">
                    Nenhum Acordo localizado para realizar os feedbacks...
                </div>

            <?php else : ?>

                <table id="acordo" class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <td>ID</td>
                            <td>Acordos</td>
                            <td>Matricula</td>
                            <td>Status</td>
                            <td>Fedeback</td>
                            <td>Fedeback</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($acordos as $acordo) : ?>
                            <tr>
                                <td><?php echo $acordo['id']; ?></td>
                                <td><?php echo $acordo['titulo']; ?></td>
                                <td><?php echo $acordo['matricula']; ?></td>
                                <td><?php echo $acordo['status']; ?></td>
                                <td><a href="feedback.php?id=<?php echo $acordo['id']; ?>">Adicionar</a></td>
                                <td><a href="lista-feedback.php?id=<?php echo $acordo['id']; ?>">Visualizar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
        </div>
    </main>
   
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>