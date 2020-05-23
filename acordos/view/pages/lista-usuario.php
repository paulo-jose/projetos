<?php

require("../../config.php");
require("../../model/Usuario.php");
require("../../model/Feedback.php");
require('../../src/autenticacao-login.php');

$usuario = new Usuario($mysql);


if ($_SESSION['usuario']['matricula'] == 'c138255' || $_SESSION['usuario']['matricula'] == 'c103900')
    $usuarios = $usuario->buscarTodos();
else
    $usuarios = $usuario->buscarPorLotacao($_SESSION['usuario']['lotacao']);

if (!empty($_GET['id'])) {

    if ($usuario->remover($_GET['id']))
        $msg = true;
    else
        $msg = false;
}

if (!empty($_GET['idAlteracao'])) {

    $ob_usuario = $usuario->buscarPorId($_GET['idAlteracao']);

    if ($usuario->alterarStatus($_GET['idAlteracao'], $ob_usuario['status']))
        header('Location: lista-usuario.php?msg=sucesso');
    else
        header('Location: lista-usuario.php?msg=falha');
}

?>

<html>

<head>
    <title>Usuário</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=0.8" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #0000CD;">
            <button type="button" data-target="#navbarNavAltMarkup" data-toggle="collapse" class="navbar-toggle collapsed">
                <span style="color:white" class="fas fa-bars fa-2x"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/acordos/3459/index.php" style="color:white">Home</a></li>
                    <?php if ($_SESSION['usuario']['funcao'] >= '14') :; ?>
                        <li><a href="/acordos/view/pages/painel.php" style="color:white">Painel</a></li>
                        <li><a href="/acordos/view/pages/lista-usuario.php" style="color:white">Usuário</a></li>
                        <li><a href="/acordos/admin/index.php" style="color:white">Acordos</a></li>
                    <?php else :; ?>
                        <li><a href="/acordos/user/index.php" style="color:white">Acordos</a></li>
                    <?php endif; ?>
                    <li><a href="/acordos/view/pages/lista-acordo.php" style="color:white">Feedbacks</a></li>
                    <li><a href="/acordos/src/logout.php"" class=" login" style="color:white"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <main class="conteudoPrincipal">
        <div class="container">
            <div class="form-group">
                <h1>Listagem dos Usuário</h1>
            </div>

            <?php if (isset($msg)) : ?>
                <?php if ($msg) : ?>
                    <div class="alert alert-success" role="alert">
                        Usuário removido com sucesso!!
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Usuário não pode ser removido!!
                    </div>
                <?php endif; ?>
            <?php endif; ?>


            <?php if (isset($_GET['msg'])) : ?>
                <?php if ($_GET['msg'] == 'sucesso') : ?>
                    <div class="alert alert-success" role="alert">
                        Operação realizada com sucesso!!
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Falha em realizar operação!!
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form id="from" name="from" action="lista-usuario.php" method="post">

                <?php if (empty($usuarios)) : ?>
                    <div class="alert alert-warning" role="alert">
                        Nenhum Usuário localizado..
                    </div>

                <?php else : ?>
                    <div class="table-responsive">
                        <table id="acordo" class="table table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nome</td>
                                    <td>Matricula</td>
                                    <td>Lotação</td>
                                    <td>Deletar</td>
                                    <?php if ($_SESSION['usuario']['matricula'] == 'c138255' || $_SESSION['usuario']['matricula'] == 'c103900') : ?>
                                        <td>Opção</a></td>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario) : ?>
                                    <tr>
                                        <td><?php echo $usuario['id']; ?></td>
                                        <td><?php echo $usuario['nome']; ?></td>
                                        <td><?php echo $usuario['matricula']; ?></td>
                                        <td><?php echo $usuario['lotacao']; ?></td>
                                        <td><a href="lista-usuario.php?id=<?php echo $usuario['id']; ?>"><button type="button" class="btn btn-danger">Remover</button></a></td>
                                        <?php if ($_SESSION['usuario']['matricula'] == 'c138255' || $_SESSION['usuario']['matricula'] == 'c103900') : ?>
                                            <td><a href="lista-usuario.php?idAlteracao=<?php echo $usuario['id']; ?>"><button type="button" class="btn btn-success"><?php if ($usuario['status'] == 'habilitado') echo "Desabilitar";
                                                                                                                                                                    else echo "Habilitar "; ?></button></a></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>