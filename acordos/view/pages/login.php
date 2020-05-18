<?php

require('../../src/sessao.php');
?>

<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <header class="cabecalhoPrincipal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4">
                    <h1 class="logo"><img src="../imagens/logo-caixa.png" alt="Caixa" /></h1>
                </div>
            </div>
    </header>
    <div id="login">
        <h3 class="text-center text-white pt-5"></h3>
        <div class="container">
            <?php if (isset($_GET['falha'])) : ?>
                <div class="alert alert-danger">
                    <strong>Falha: </strong> usuário ou senha invalido
                </div>
            <?php endif ?>

            <?php if (isset($_GET['msg'])) : ?>
                <?php if (($_GET['msg'])) : ?>
                    <div class="alert alert-success" role="alert">
                        Usuário cadastrado com sucesso!!
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Usuário não pode ser cadastrado!!
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <main class="container body-content center-block">
                <div id="login-row" class="row">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="login.php" method="post">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">matricula:</label><br>
                                    <input type="text" name="matricula" id="matricula" class="form-control" placeholder="ex: c123456">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">senha:</label><br>
                                    <input type="password" name="cpf" id="cpf" minlength="6" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="remember-me" class="text-info"><span>lembre-me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Entrar">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="/acordos/view/pages/cadastro-usuario.php" class="text-info">Cadastrar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    <footer class="footer nav navbar-fixed-botom " style="background: #0000CD">
        <div class="container text-center nav navbar-fixed-botom">
            <small style="color: white"> Desenvolvido por: Paulo José de Sousa</small></br>
            <small style="color: white">Matrícula: c138255-8</small>
        </div>
    </footer>
</body>

</html>