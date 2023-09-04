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

    public function save(CorrentistaModel $m) : CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }


    public function select()
    {
        $sql = "SELECT * FROM Correntista";

          $stmt = $this->conexao->prepare($sql);
          $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
        
    }

    public function getCorrentistaByCpfAndSenha($cpf, $senha)
    {
        $sql = "SELECT FROM nome, senha FROM Correntista WHERE CPF = ? AND senha = sha1(?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        $obj = $stmt->fetchObject("App\Model\CorrentistaModel");

        return is_object($obj) ? $obj : new CorrentistaModel();
    }
    
    public function insert(CorrentistaModel $m) : CorrentistaModel
    {
        $sql = "INSERT INTO Correntista (nome, CPF, senha) VALUES (?, ?, ?)";

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
        $sql = "UPDATE Correntista SET nome=?, CPF=? senha= sha1(?) WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->cpf);
        $stmt->bindValue(3, $m->senha);
        $stmt->bindValue(4, $m->id);

        return $stmt->execute();
    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM Correntista c WHERE id = ?";

         $stmt = $this->conexao->prepare($sql);
         $stmt->bindValue(1, $id);

         $stmt->execute();
           
         return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM Correntista WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}