<?php

class Feedback
{

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function adicionar(string $descricao, string $idAcordo, string $usuario) : bool
    {
        $dataAtual = date('d/m/Y');
        $idAcordo = (int) $idAcordo;
        $stmd = $this->mysql->prepare('INSERT INTO `feedback`(`descrição`, `data`, `idAcordo`, `usuario` ) VALUES (?,?,?, ?);');
        $stmd->bind_param('ssss', $descricao, $dataAtual, $idAcordo, $usuario);
        if($stmd->execute())
            return true;
        else
            return false;
    }


    public function buscarPorId($id) : array
    {
        $idAcordo = (int) $id;

        $stm = $this->mysql->prepare("SELECT feedback.id, feedback.descrição, acordo.matricula, acordo.titulo FROM feedback INNER JOIN acordo ON feedback.idAcordo = acordo.id WHERE feedback.id = ?");
        $stm->bind_param('s', $id);
        if($stm->execute())
        {
            $result = $stm->get_result();
            $stm->close();
            $feedbacks =  $result->fetch_assoc();
            return $feedbacks;
        }  
            
    }

    public function buscarPorIdAcordo($idAcordo) : array
    {
        $idAcordo = (int) $idAcordo;

        $stm = $this->mysql->prepare("SELECT * FROM `feedback` WHERE idAcordo = ?");
        $stm->bind_param('s', $idAcordo);
        if($stm->execute())
        {
            $feedbacks = array();
            $result = $stm->get_result();
            while($row = $result->fetch_assoc()) {
                $feedbacks[] = $row;
            }
            $stm->close();
            return $feedbacks;
        } 
        
        return null;
    }


    public function buscarPorAgencia(string $lotacao) : array
    {
        $resultado = $this->mysql->query("SELECT feedback.id, feedback.descrição, feedback.idAcordo, feedback.usuario, feedback.data, acordo.titulo FROM feedback INNER JOIN acordo ON feedback.idAcordo = acordo.id INNER JOIN usuario ON acordo.matricula = usuario.matricula WHERE lotacao = '{$lotacao}'");
       if($resultado == false)
       {
           
            return $array = array("id"=> "0",
                                "descrição" => "",
                                 "data"=> "",
                                 "usuario"=> "",
                                 "idAcordo" => "",
                                );
       }
      
       $feedbacks = $resultado->fetch_all(MYSQLI_ASSOC);
       return $feedbacks;
    }


    public function buscarPorData(string $lotacao, string $data) : array
    {
        $resultado = $this->mysql->query("SELECT feedback.id, feedback.descrição, feedback.usuario, feedback.data, feedback.idAcordo, acordo.titulo FROM feedback INNER JOIN acordo ON feedback.idAcordo = acordo.id INNER JOIN usuario ON acordo.matricula = usuario.matricula WHERE lotacao = '{$lotacao}' AND data = '{$data}'");
        if($resultado == false)
        {
            
             return null;
        }
       
        $feedbacks = $resultado->fetch_all(MYSQLI_ASSOC);
        return $feedbacks;
    }

    public function remover(string $id):void
    {
        $stmd = $this->mysql->prepare('DELETE FROM feedback WHERE id = ?');
        $stmd->bind_param('s', $id);
        $stmd->execute();
    }

}
