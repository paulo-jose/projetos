<?php

require("../../config.php");
require("../../model/Acordo.php");
require("../../model/Usuario.php");
require('../../src/autenticacao-login.php');

$usuario = new Usuario($mysql);
$obj_acordo = new Acordo($mysql);
$acordo['id'] = "";
$acordo['titulo'] = "";
$acordo['descrição'] = "";
$acordo['matricula'] = "";



if (!empty($_GET['id'])) {
    $acordo = $obj_acordo->buscarPorId($_GET['id']);
} else {


    $usuarios = $usuario->buscarPorAgencia($_SESSION['usuario']['lotacao'], $_SESSION['usuario']['matricula']);


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['id'])) {
        $nomeArquivo;

        if (isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['name'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
            $nomeArquivo = $acordo['id'] . $_FILES['arquivo']['name']; //define o nome do arquivo
            $diretorio = "upload/"; //define o diretorio para onde enviaremos o arquivo
            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $nomeArquivo))
                $_SESSION['msgArquivo'] = true;
            else
                $_SESSION['msgArquivo'] = false;
        } else
            $nomeArquivo = "";

        if ($usuario->verificarMatricula($_POST['matricula'])) {
            if ($obj_acordo->adicionar($_POST['titulo'], $_POST['descrição'], $_POST['matricula'], "Pedente", $nomeArquivo)) {
                header('Location: ../../admin/index.php?msg=true');
                die();
            } else
                header('Location: ../../admin/index.php?msg=false');
            die();
        } else {
            header('Location: ../../admin/index.php?msgUsuario=false');
            die();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {

        if ($usuario->verificarMatricula($_POST['matricula'])) {
            if ($obj_acordo->atualizar($_POST['id'], $_POST['titulo'], $_POST['descrição'], $_POST['matricula'], "Pedente")) {
                header('Location: ../../admin/index.php?msgEditar=true');
                die();
            } else
                header('Location: ../../admin/index.php?msgEditar=false');
            // echo  "<script>alert('Cadastro efetuado com sucesso!');</script>";
            die();
        } else {
            header('Location: ../../admin/index.php?msgUsuario=false');
            die();
        }
    }
}

?>

<html>

<head>
    <title>Edição</title>
    <meta content="width=device-width, initial-scale=0.8" name="viewport">
    <meta charset="UTF-8">
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

            <h1>Cadastrar Acordos</h1>

            <form id="form1" name="form1" action="./acordos.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $acordo['id']; ?>" />

                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $acordo['titulo'] ?>" placeholder="Titulo do Acordo" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea cols="20" rows="10" id="descrição" name="descrição" placeholder="fale sobre o acordo" class="form-control" required><?php echo $acordo['descrição'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="titulo">Matricula:</label>
                    <select class="form-control" id="matricula" name="matricula" required>
                        <?php if (isset($usuarios) && count($usuarios) > 0) : ?>
                            <option selected>Escolha o empregado</option>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <option><?php echo $usuario['matricula'] ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option selected value="0">Nenhum empregado cadastrado</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="arquivo" id="arquivo" lang="pt">
                        <label class="custom-file-label" for="arquivo" placeholder="Arquivo" value="arquivo"></label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Enviar" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>