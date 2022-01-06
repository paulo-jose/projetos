<?php

$servidor = "localhost";
$usuario = "root";
$senha = "****";
$bd = "sistemadeacordos";

// $servidor = "sql302.epizy.com";
// $usuario = "epiz_25634395";
// $senha = "e1FKSUg4WGPfc";
// $bd = "epiz_25634395_sistemadeacordo";

//  $mysql = new mysqli('sql302.epizy.com', 'epiz_25634395', 'e1FKSUg4WGPfc', 'epiz_25634395_sistemadeacordos');
//  $mysql->set_charset("utf8");

// if($mysql == false)
//     echo "conexao falhou";

$mysql = new mysqli($servidor, $usuario, $senha, $bd);
$mysql->set_charset("utf8");

if ($mysql == false)
    echo "conexao falhou";


