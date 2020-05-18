<!DOCTYPE html>
<html lang="pt-br">

<?php

include '../model/Acordo.php';
require '../config.php';
require('../src/autenticacao-login.php');

$acordos = new Acordo($mysql);

if (!empty($_GET['id'])) {


	if ($acordos->remover($_GET['id']))
		$flagRemove = true;
	else
		$flagRemove = false;
}



$acordos = $acordos->exibirPorAgencia($_SESSION['usuario']['lotacao']);


?>

<html lang="pt-BR">

<head>
	<title>Acordos</title>
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

		<nav class="navbar float-right d-none d-lg-block" style="background-color: #0000CD;">

			<ul class="nav navbar-nav d-none navbar-right">
				<li><a href="/acordos/view/pages/painel.php" style="color:white">Home</a></li>
				<li><a href="/acordos/view/pages/lista-usuario.php" style="color:white">Usuário</a></li>
				<li><a href="index.php" style="color:white">Acordos</a></li>
				<li><a href="/acordos/view/pages/lista-acordo.php" style="color:white">Feedbacks</a></li>
				<li><a href="../src/logout.php"" class=" login" style="color:white"><span class="glyphicon glyphicon-log-in"></span> Logaut</a></li>
			</ul>
		</nav>
	</header>

	<main class="conteudoPrincipal">
		<div class="container">

			<!-- Bloco de validação de dados e mesagem para usuario  -->


			<?php if (isset($flagRemove)) : ?>
				<?php if ($flagRemove) : ?>
					<div class="alert alert-success" role="alert">
						Acordo removido com sucesso!!
					</div>
				<?php else : ?>
					<div class="alert alert-danger" role="alert">
						Acordo não pode ser removido!!
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (isset($_GET['msg'])) : ?>
				<?php if (($_GET['msg'])) : ?>
					<div class="alert alert-success" role="alert">
						Acordo cadastrado com sucesso!!
					</div>
				<?php else : ?>
					<div class="alert alert-danger" role="alert">
						Acordo não pode ser cadastrado!!
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (isset($_GET['msgEditar'])) : ?>
				<?php if (($_GET['msgEditar'])) : ?>
					<div class="alert alert-success" role="alert">
						Acordo editado com sucesso!!
					</div>
				<?php else : ?>
					<div class="alert alert-danger" role="alert">
						Acordo não pode ser editado
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<!-- Fim do bloco de validação de dados e mesagem para usuario  -->



			<div class="nav navbar-nav navbar-right">
				<!-- <a  hrf="../view/pages/acordos.php" class="btn btn-primary btnCircular btnPrincipal" >Cadastrar  <i class="fa fa-plus" size="2x"></i></a> -->
			</div>
			<a href="../view/pages/acordos.php" class="form-group nav navbar-nav navbar-right">
				<div class="btn btn-primary">Cadastrar <i class="fa fa-plus fa-sm"></i></div>
			</a>

			<h1> Acordos </h1>

			<?php if (isset($_GET['msgUsuario'])) : ?>
				<div class="alert alert-danger" role="alert">
					Usuario não localizado por favor cadastra o usuário antes de inserir/editar o acordo.
				</div>
			<?php endif; ?>

			<?php if (empty($acordos)) : ?>
				<div class="alert alert-warning" role="alert">
					Nenhum Acordo localizado ...
				</div>
			<?php else : ?>
				<table id="acordo" class="table table-striped table-dark">
					<thead class="thead-dark">
						<tr>
							<td>ID</td>
							<td>Acordos</td>
							<td>Matricula</td>
							<td>Status</td>
							<td>Editar</td>
							<td>Remover</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($acordos as $acordo) : ?>
							<tr>
								<td><?php echo $acordo['id']; ?></td>
								<td><?php echo $acordo['titulo']; ?></td>
								<td><?php echo $acordo['matricula']; ?></td>
								<td><?php echo $acordo['status']; ?></td>
								<td><a href="../view/pages/acordos.php?id=<?php echo $acordo['id']; ?>">Editar</a></td>
								<td><a href="index.php?id=<?php echo $acordo['id']; ?>">Remover</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				<?php endif; ?>
				</table>
		</div>
	</main>

	<!-- <footer class="footer" style="background: #0000CD">
        <div class="container text-center">
            <small style="color: white"> Desenvolvido por: Paulo José de Sousa</br></small>
            <small style="color: white">Matrícula: c138255-8</small>
        </div>
    </footer> -->

</body>

</html>