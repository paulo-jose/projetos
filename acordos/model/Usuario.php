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
        $status = 'desabilitado';
        $stmd = $this->mysql->prepare('INSERT INTO `usuario`(`nome`, `cpf`, `matricula`, `lotacao`, `funcao`, `status` ) VALUES (?,?,?,?,?,?);');
        $stmd->bind_param('ssssss', $nome, $cpf, $matricula, $lotacao, $funcao, $status );
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

    public function alterarStatus(string $id, string $status)
    {

        if($status == 'habilitado')
            $status = 'desabilitado';
        else
            $status = 'habilitado';

        $stmd = $this->mysql->prepare('UPDATE usuario SET status = ? WHERE id = ?');
        $stmd->bind_param('ss', $status, $id);
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

    public function buscarPorId($id) : array
    {
        $stm = $this->mysql->prepare("SELECT * FROM `usuario` WHERE id = ?");
        $stm->bind_param('s', $id);
        $stm->execute();
        $usuario = $stm->get_result()->fetch_assoc();
        return $usuario;
    }

    public function buscarPorMatricula($matricula):array
    {
        $usuario = [];
        $stm = $this->mysql->prepare("SELECT * FROM `usuario` WHERE matricula = ?");
        $stm->bind_param('s', $matricula);
        if($stm->execute())
        {
            $usuario = $stm->get_result()->fetch_assoc();
            if($usuario == null)
                return $usuario = [];
            else
                return $usuario;
        }
            

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

    public function buscarPorAgencia($lotacao, $matricula) : array
    {
        $stm = $this->mysql->prepare("SELECT * FROM `usuario` WHERE lotacao = ? AND matricula != ?");
        $stm->bind_param('ss', $lotacao, $matricula);
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


    


    public function buscarTodos(): array
    {
       $resultado = $this->mysql->query('SELECT * FROM usuario');
       if($resultado == false)
             return $array = array();

       $acordos = $resultado->fetch_all(MYSQLI_ASSOC);
       return $acordos;
       
    }

    


}
