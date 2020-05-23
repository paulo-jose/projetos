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
    <meta content="width=device-width, initial-scale=0.8" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../view/css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../view/css/fontawesome.min.css">
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
                    <li><a href="index.php" style="color:white">Acordos</a></li>
                    <li><a href="/acordos/view/pages/lista-acordo.php" style="color:white">Feedbacks</a></li>
                    <li><a href="/acordos/src/logout.php"" class=" login" style="color:white"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <main class="conteudoPrincipal">
        <div class="container">
            <h1>Acordos </h1>

            <?php if (empty($acordos)) : ?>
                <div class="alert alert-warning" role="alert">
                    Nenhum Acordo localizado ...
                </div>
            <?php else : ?>
                <div class="table-responsive">
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
                                    <td><a href="../view/pages/user-acordos.php?id=<?php echo $acordo['id']; ?>"><button type="button" class="btn btn-primary">Visualizar</button></a></td>
                                    <?php if (!empty($acordo['arquivo'])) :; ?>
                                        <td><a href="/acordos/view/pages/upload/<?php echo $acordo['arquivo']; ?>" download="<?php echo $acordo['arquivo']; ?>"><button type="button" class="btn btn-success">Download</button></a></td>
                                    <?php else :; ?>
                                        <td><a href="" onclick="alert('Nenhuma anexo enviado');">Download</a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                    </table>
                </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>