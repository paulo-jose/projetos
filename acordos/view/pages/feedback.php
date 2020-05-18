<?php

require("../../config.php");
require("../../model/Acordo.php");
require("../../model/Feedback.php");
require('../../src/autenticacao-login.php');


$obj_acordo = new Acordo($mysql);
$acordo['id'] = "";
$acordo['titulo'] = "";
$acordo['descrição'] = "";
$acordo['matricula'] = "";

if (!empty($_GET['id'])) {
    $acordo = $obj_acordo->buscarPorId($_GET['id']);
} else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
        $feedback = new Feedback($mysql);
        if ($feedback->adicionar($_POST['descrição'], $_POST['id'], $_SESSION['usuario']['matricula'])) {
            header('Location: lista-acordo.php?msg=true');
            die();
        } else
            header('Location: lista-acordo.php?msg=false');
        die();
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
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.mim.css">

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

            <h1>Cadastrar Feedback</h1>


            <form id="from" name="from" action="feedback.php" method="post">

                <input type="hidden" name="id" value="<?php echo $acordo['id']; ?>" />

                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $acordo['titulo'] ?>" placeholder="coloque o titulo" class="form-control" disabled />
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea cols="20" rows="10" id="descrição" name="descrição" placeholder="fale sobre a descricao" class="form-control" disabled><?php echo $acordo['descrição'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="titulo">Matricula:</label>
                    <input type="text" id="matricula" name="matricula" value="<?php echo $acordo['matricula'] ?>" placeholder="c123456" class="form-control" disabled />
                </div>
                <div class="form-group">
                    <label for="descricao">Feedback:</label>
                    <textarea cols="20" rows="10" id="descrição" name="descrição" placeholder="Descreva sobre feedback deste acordo..." class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <input type="submit" value="Enviar" class="btn btn-primary" />
                    </div>
                </div>

            </form>
        </div>

    </main>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>