<?php

session_start();

require("../../config.php");
require("../../model/Usuario.php");
$usuario = new Usuario($mysql);

if(!empty($_POST['matricula']) || !empty($_POST['cpf']) )
{
    $matricula = mysqli_real_escape_string($mysql, $_POST['matricula']);
    $cpf = mysqli_real_escape_string($mysql, $_POST['cpf']);
    $usuario = new Usuario($mysql);
    
    if($usuario->autenticar($matricula, $cpf) == 1 )
    {
        $obj_user = $usuario->buscarPorMatricula($matricula);
        $_SESSION['usuario'] = $obj_user;
       if($obj_user["funcao"] >= "14")
            header('Location: /acordos/3459/index.php');           
       else
            header('Location:  /acordos/3459/index.php');
    }
    else
    {
        header('Location: login.php?falha=true');
    } 
}
?>

