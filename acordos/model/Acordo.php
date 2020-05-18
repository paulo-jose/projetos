
<?php

class Acordo
{

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }


    public function adicionar(string $titulo, string $descricao, string $matricula, string $status, string $arquivo) : bool
    {
        $stmd = $this->mysql->prepare('INSERT INTO `acordo`(`titulo`, `descrição`, `matricula`, `status`, `arquivo` ) VALUES (?,?,?,?,?);');
        $stmd->bind_param('sssss', $titulo, $descricao, $matricula, $status, $arquivo);
        if($stmd->execute())    
            return true;
        else
            return false;
    }

    
    public function atualizar(string $id, string $titulo, string $descricao, string $matricula, string $status) : void
    {
        $stmd = $this->mysql->prepare('UPDATE acordo SET titulo = ?, descrição = ?, matricula = ?, status = ? WHERE id = ?');
        $stmd->bind_param('sssss', $titulo, $descricao, $matricula, $status, $id);
        $stmd->execute();
    }

    public function remover(string $id):bool
    {
        $stmd = $this->mysql->prepare('DELETE FROM acordo WHERE id = ?');
        $stmd->bind_param('s', $id);
        if($stmd->execute())
            return true;
        else 
            return false;
    }


    public function exibirTodos(): array
    {
       $resultado = $this->mysql->query('SELECT * FROM acordo');
       if($resultado == false)
       {
           
            return $array = array("id"=> "0",
                                "titulo" => "",
                                 "matricula"=> "",
                                 "status"=> "");
       }
      
       $acordos = $resultado->fetch_all(MYSQLI_ASSOC);
       return $acordos;
       
    }

    public function exibirPorAgencia($lotacao): array
    {
        $resultado = $this->mysql->query("SELECT acordo.id, acordo.titulo, acordo.descrição, acordo.matricula, acordo.arquivo, acordo.status FROM acordo INNER JOIN usuario ON acordo.matricula = usuario.matricula WHERE lotacao = '{$lotacao}'");
       if($resultado == false)
       {
           
            return $array = array("id"=> "0",
                                "titulo" => "",
                                 "matricula"=> "",
                                 "status"=> "");
       }
      
       $acordos = $resultado->fetch_all(MYSQLI_ASSOC);
       return $acordos;
       
    }

    public function buscarPorId(string $id):array
    {

        $stm = $this->mysql->prepare("SELECT * FROM `acordo` WHERE id = ?");
        $stm->bind_param('s', $id);
        $stm->execute();
        $acordo = $stm->get_result()->fetch_assoc();
        return $acordo;
    }
    
    public function buscarPorMatricula(string $matricula):array
    {

        $stm = $this->mysql->prepare("SELECT * FROM `acordo` WHERE matricula = ?");
        $stm->bind_param('s', $matricula);
        if($stm->execute())
        {
            $acordos = array();
            $result = $stm->get_result();
            while($row = $result->fetch_assoc()) {
                $acordos[] = $row;
            }
            $stm->close();
            return $acordos;
        } 
        
        return null;
    }


    public function consultarStatus($acordos): array
    {

        foreach($acordos as $acordo)
        {
            if($acordo['status'] == "Aceito")
                $result[] = $acordo;
        }
        return $result;
    }

}


?>  