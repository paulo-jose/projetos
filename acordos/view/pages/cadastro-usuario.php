<?php

require("../../model/Usuario.php");
require("../../config.php");

$usuario = new Usuario($mysql);
$msg = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($usuario->verificarMatricula($_POST['matricula']))
        $msg = true;
    else {

        if ($usuario->inserir($_POST['nome'], $_POST['cpf'], $_POST['matricula'], $_POST['lotacao'], $_POST['funcao']))
            header('Location: login.php?msg=true');
        else
            header('Location: login.php?msg=false');
    }
}

?>

<html>

<head>
    <title>Cadastro</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=0.8" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/casadocodigo.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome.min.css">

</head>

<body>

    <header class="cabecalhoPrincipal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4">
                    <h1 class="logo"><img src="../imagens/logo-caixa.png" alt="Caixa" /></h1>
                </div>
            </div>
        </div>
    </header>

    <main class="conteudoPrincipal">
        <div class="container">

            <h1>Cadastro de Usuário</h1>

            <?php if ($msg) : ?>
                    <div class="alert alert-danger" role="alert">
                        Matrícula já cadastrada!
                    </div>
            <?php endif; ?>


            <form id="from" name="from" action="./cadastro-usuario.php" method="post">


                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" require value="" placeholder="Digite seu nome" class="form-control" required />
                </div>

                <div class="form-group">
                    <label for="titulo">Matricula:</label>
                    <input type="text" id="matricula" name="matricula" maxlength="7" value="" placeholder="c123456" class="form-control" required />
                </div>

                <div class="form-group">
                    <label for="pwd">Senha:</label>
                    <input type="password" id="cpf" name="cpf" require value="" class="form-control" minlength="6" maxlength="10" required />
                </div>

                <div class="form-group">
                    <label>Agência:</label>
                    <select class="form-control custom-select" name="lotacao" size=5 required>
                        <option selected>Escolha sua Agência</option>

                        <option value="610">610 - ARAGUAINA</option>

                        <option value="793">793 - GURUPI</option>

                        <option value="861">861 - LAGOA DA CONF.</option>

                        <option value="1116">1116 - COLINAS</option>

                        <option value="1141">1141 - PARAISO</option>

                        <option value="1737">1737 - MIRACEMA</option>

                        <option value="1829">1829 - PORTO NACIONAL</option>

                        <option value="2525">2525 - PALMAS</option>

                        <option value="2812">2812 - ARAGUATINS</option>

                        <option value="3089">3089 - DIANOPOLIS</option>

                        <option value="3314">3314 - TOCANTINS</option>

                        <option value="3385">3385 - TOCANTINOPOLIS</option>

                        <option value="3458">3458 - JALAPAO</option>

                        <option value="3459">3459 - SERRA DO CARMO</option>

                        <option value="3464">3464 - RIO LONTRA</option>

                        <option value="3738">3738 - SERRA GERAL</option>

                        <option value="3863">3863 - JAVAE</option>

                        <option value="3924">3924 - JUST. FED. PALMAS</option>

                        <option value="3939">3939 - TAQUARALTO</option>

                        <option value="4065">4065 - PREF MUN PALMAS</option>

                        <option value="4380">4380 - ALTO SAO JOAO</option>

                        <option value="4381">4381 - AUGUSTINOPOLIS</option>

                        <option value="4481">4481 - GUARAI</option>

                        <option value="5152">5152 - SEV GURUPI</option>

                        <option value="5712">5712 - SEV ARAGUAINA</option>

                        <option value="5812">5812 - SEV PALMAS</option>

                        <option value="2636"> 2636 - SR TOCANTINS </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Função:</label>
                    <select class="form-control custom-select" name="funcao" size=5 required>
                        <option selected>Escolha sua Função</option>
                        <option value="1">ASSIST ATEND E NEGOCIOS</option>

                        <option value="2">ASSIST REGIONAL</option>

                        <option value="3">ASSISTENTE DE VAREJO</option>

                        <option value="4">ASSISTENTE DE VAREJO DIG</option>

                        <option value="5">AVALIADOR DE PENHOR</option>

                        <option value="6">AVALIADOR EXECUTIVO PL6H</option>

                        <option value="7">CAIXA</option>

                        <option value="8">SECRETARIO</option>

                        <option value="9">TESOUREIRO EXECUTIVO</option>

                        <option value="10">TESOUREIRO EXECUTIVO 6H</option>

                        <option value="11">GERENTE VAREJO</option>

                        <option value="12">GER CLIENTES NEGOC III</option>

                        <option value="13">GERENTE CARTEIRA PF DIG</option>

                        <option value="14">GERENTE DE CARTEIRA PF</option>

                        <option value="15">GERENTE DE CARTEIRA PJ</option>

                        <option value="16">GERENTE DE REDE VAR</option>

                        <option value="17">GERENTE GERAL DE REDE</option>

                        <option value="18">GERENTE GERAL REDE DIG</option>

                        <option value="19">SUPERINTENDENTE REDE</option>

                    </select>
                </div>

                <div class="form-group">
                    <p></p>
                    <input type="submit" value="Cadastrar" class="btn btn-primary" />
                </div>

            </form>
        </div>
    </main>
    <!-- <footer class="footer" style="background: #0000CD">
        <div class="container text-center">
            <small style="color: white"> Desenvolvido por: Paulo José de Sousa</br></small>
            <small style="color: white">Matrícula: c138255-8</small>
        </div>
    </footer> -->

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
   
    <script>
        $("#matricula").on("input", function(){
             $(this).val($(this).val().toLowerCase());
        });
    </script>

</body>
</html>