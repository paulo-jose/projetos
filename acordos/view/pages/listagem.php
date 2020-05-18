<?php

require("../../config.php");
require("../../model/Acordo.php");
require("../../model/Feedback.php");
require('../../src/autenticacao-login.php');

$feedback = new Feedback($mysql);
$acordo = new Acordo($mysql);
$objeto = null;
if (!empty($_GET['idAcordo'])) {
    $objeto = $acordo->buscarPorId($_GET['idAcordo']);
    
} else {
    if(isset($_GET['id']))
        $objeto = $feedback->buscarPorId($_GET['id']);
}

?>

<head>
    <title>Listagem</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="UTF-8">
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

            <h1>Listagem</h1>

            <form id="form1" name="form1" action="./painel.php"  enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $objeto['id']; ?>" />

                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $objeto['titulo'] ?>" placeholder="Titulo do Acordo" class="form-control" disabled />
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea cols="20" rows="10" id="descrição" name="descrição" placeholder="fale sobre o acordo" class="form-control" disabled><?php echo $objeto['descrição'] ?></textarea>
                </div>  
                
                <div class="form-group">
                    <input type="submit" value="Volta" class="btn btn-success" />
                </div>
            </form>
        </div>
    </main>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</body>