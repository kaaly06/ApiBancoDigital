<?php

namespace ApiBancoDigital\DAO;

use ApiBancoDigital\Model\CorrentistaModel;
use PDO;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select()
    {
        $sql = "SELECT c.*,
        co.nome as nome_conta              
                FROM conta c              
                JOIN correntista co ON co.id = c.id_correntista";

          $stmt = $this->conexao->prepare($sql);
          $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
        
    }

    public function selectByCpfAndSenha($cpf, $senha)
    {
        $sql = "SELECT nome, senha FROM correntista WHERE cpf=? AND senha= sha1(?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        $obj = $stmt->fetchObject("App\Model\CorrentistaModel");

        return is_object($obj) ? $obj : new CorrentistaModel();
    }
    
    public function insert(CorrentistaModel $m) : CorrentistaModel
    {
        $sql = "INSERT INTO correntista (nome, CPF, senha) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->cpf);
        $stmt->bindValue(3, $m->senha);
        $stmt->execute();

        $m->id = $this->conexao->lastInsertId(); //resgata a ultima inserção do banco

        return $m;
    }

    public function update(CorrentistaModel $m) : bool
    {
        $sql = "UPDATE correntista SET usuario=?, cpf=? senha=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->cpf);
        $stmt->bindValue(3, $m->senha);
        $stmt->bindValue(4, $m->id);

        return $stmt->execute();
    }

    public function selectById($id)
    {
        $sql = "SELECT c.*,
                       co.nome as nome_conta              
                FROM conta c              
                JOIN correntista co ON co.id = c.id
                 WHERE id = ?";

         $stmt = $this->conexao->prepare($sql);
         $stmt->bindValue(1, $id);

         $stmt->execute();
           
         return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}