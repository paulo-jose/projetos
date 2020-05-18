<?php


require('../src/autenticacao-login.php');
require('../model/Acordo.php');
require('../config.php');

$acordos = new Acordo($mysql);

$acordos = $acordos->buscarPorMatricula($_SESSION['usuario']['matricula']);


?>

<head>
    <title>Listagem de Acordos</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../view/css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../view/css/fontawesome.min.css">
    <script src="../view/js/jquery.min.js" type="text/javascript"></script>
    <script src="../view/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #0000CD;">

            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php" style="color:white">Acordos</a></li>
                <li><a href="/acordos/view/pages/lista-acordo.php" style="color:white">Feedbacks</a></li>
                <li><a href="/acordos/src/logout.php"" class=" login" style="color:white"><span class="glyphicon glyphicon-log-in"></span> Logaut</a></li>
            </ul>
            </div>
        </nav>
    </header>
    <main class="conteudoPrincipal">
        <div class="container">
            <h1>Acordos </h1>

            <table id="acordo" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <td>ID</td>
                        <td>Acordos</td>
                        <td>Status</td>
                        <td>Visualizar</td>
                        <td>Download</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($acordos as $acordo) : ?>
                        <tr>
                            <td><?php echo $acordo['id']; ?></td>
                            <td><?php echo $acordo['titulo']; ?></td>
                            <td><?php echo $acordo['status']; ?></td>
                            <td><a href="../view/pages/user-acordos.php?id=<?php echo $acordo['id']; ?>">Visualizar</a></td>
                            <?php if (!empty($acordo['arquivo'])) :; ?>
                                <td><a href="/acordos/view/pages/upload/<?php echo $acordo['arquivo']; ?>" download="<?php echo $acordo['arquivo']; ?>">Download</a></td>
                            <?php else :; ?>
                                <td><a href="" onclick="alert('Nenhuma anexo enviado');">Download</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>