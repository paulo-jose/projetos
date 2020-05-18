<?php

require("../../config.php");
require("../../model/Acordo.php");
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
        $obj_acordo->atualizar($_POST['id'], $_POST['titulo'], $_POST['descrição'], $_POST['matricula'], 'Aceito');
        header('Location: ../../user/index.php');
        die();
    }
}

?>

<html>

<head>
    <title>Usuário</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.mim.css">
    <script src="../view/js/jquery.min.js" type="text/javascript"></script>
    <script src="../view/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #0000CD;">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ((int)$_SESSION['usuario']['funcao'] >= 14) :; ?>
                    <li><a href="/acordos/view/pages/painel.php" style="color:white">Home</a></li>
                    <li><a href="/acordos/view/pages/lista-usuario.php" style="color:white">Usuário</a></li>
                    <li><a href="/acordos/admin/index.php" style="color:white">Acordos</a></li>
                <?php else :; ?>
                    <li><a href="/acordos/user/index.php" style="color:white">Acordos</a></li>
                <?php endif; ?>
                <li><a href="/acordos/view/pages/lista-acordo.php" style="color:white">Feedbacks</a></li>
                <li><a href="/acordos/src/logout.php"" class=" login" style="color:white"><span class="glyphicon glyphicon-log-in"></span> Logaut</a></li>
            </ul>
            </div>
        </nav>
    </header>
    <main class="conteudoPrincipal">
        <div class="container">

            <h1>Acordo</h1>


            <form id="from" name="from" action="./user-acordos.php" method="post">

                <input type="hidden" name="id" value="<?php echo $acordo['id']; ?>" />
                <input type="hidden" name="status" value="<?php echo $acordo['status']; ?>" />

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
                    <label for="titulo">Opção:</label>
                    <select class="form-control" id="select" onchange="verificar()">
                        <option value=''>Selecione a opção</option>
                        <option id="op" value="1">Editar</option>
                        <option id="op" value="2">Aceitar</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" id="btn" value="Enviar" class="btn btn-primary" disabled onclick="habilitarFormulario()" />
                </div>
            </form>
        </div>
    </main>

    <footer class="footer" style="background: #0000CD">
        <div class="container text-center">
            <small style="color: white"> Desenvolvido por: Paulo José de Sousa</br></small>
            <small style="color: white">Matrícula: c138255-8</small>
        </div>
    </footer>

    <script>
        function verificar() {
            var optionSelect = document.getElementById("select").value;

            if (optionSelect == "1") {

                document.getElementById("titulo").disabled = false;
                document.getElementById("descrição").disabled = false;
                document.getElementById("btn").disabled = true;
            } else {

                document.getElementById("titulo").disabled = true;
                document.getElementById("descrição").disabled = true;
                document.getElementById("btn").disabled = false;

            }
        }

        function habilitarFormulario() {
            document.getElementById("matricula").disabled = false;
            document.getElementById("titulo").disabled = false;
            document.getElementById("descrição").disabled = false;
            document.getElementById("status").value = "aceito";
        }
    </script>


<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>