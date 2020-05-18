<?php

class Usuario
{

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }


    public function inserir(string $nome, string $cpf, string $matricula, string $lotacao, string $funcao) : bool
    {
        $cpf = md5($cpf);
        $stmd = $this->mysql->prepare('INSERT INTO `usuario`(`nome`, `cpf`, `matricula`, `lotacao`, `funcao` ) VALUES (?,?,?,?,?);');
        $stmd->bind_param('sssss', $nome, $cpf, $matricula, $lotacao, $funcao);
        if($stmd->execute())    
            return true;
        else
            return false;
    }


    public function remover(string $id)
    {
        $stmd = $this->mysql->prepare('DELETE FROM usuario WHERE id = ?');
        $stmd->bind_param('s', $id);
        if($stmd->execute())
            return true;
        else 
            return false;
    }

    public function autenticar($matricula, $cpf) : int
    {
        $query  = "SELECT * FROM usuario where matricula = '{$matricula}' and cpf = md5('{$cpf}')";
        $result = mysqli_query($this->mysql, $query);
        $row = mysqli_num_rows($result);
        return $row;
    }


    public function verificarMatricula($matricula) : bool
    {
        $stm = $this->mysql->prepare("SELECT * FROM `usuario` WHERE matricula = ?");
        $stm->bind_param('s', $matricula);
        $stm->execute();
        $usuario = $stm->get_result()->fetch_assoc();
        if(empty($usuario))
            return false;
        else
           return true;
    }

    public function buscarPorMatricula($matricula) : array
    {
        $stm = $this->mysql->prepare("SELECT * FROM `usuario` WHERE matricula = ?");
        $stm->bind_param('s', $matricula);
        $stm->execute();
        $usuario = $stm->get_result()->fetch_assoc();
        return $usuario;
    }

    public function buscarPorLotacao($lotacao) : array
    {
        $stm = $this->mysql->prepare("SELECT * FROM `usuario` WHERE lotacao = ?");
        $stm->bind_param('s', $lotacao);
        if($stm->execute())
        {

            $usuarios = array();
            $result = $stm->get_result();
            while($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            $stm->close();
            return $usuarios;
        }
            
        else
            $usuario = null;
        
        return $usuario;
    }

    


}
