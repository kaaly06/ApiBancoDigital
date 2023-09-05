<?php

namespace ApiBancodigital\DAO;

use ApiBancoDigital\Model\ContaModel;
use \PDO;

class ContaDAO extends DAO
{
  public function __construct()
  {
     parent::__construct();
  }
  
  public function select() : array
  {
     $sql = "SELECT * FROM Conta";

     $stmt = $this->conexao->prepare($sql);
     $stmt->execute();

     return $stmt->fetchAll(DAO::FETCH_CLASS, "ApiBancoDigital\Model\ContaModel");
  }

  public function insert(ContaModel $model)
  {
     $sql = "INSERT INTO Conta (saldo, tipo, limite, id_Correntista) VALUES (?, ?, ?, ?)";

     $stmt = $this->conexao->prepare($sql);
     $stmt->bindValue(1, $model->saldo);
     $stmt->bindValue(2, $model->tipo);
     $stmt->bindValue(3, $model->limite);
     $stmt->bindValue(4, $model->id_Correntista);
     $stmt->execute();

     return $this->conexao->lastInsertId();

  }

  public function update(ContaModel $model)
  {   
    $sql = "UPDATE Conta SET saldo=?, tipo=? limite=?, id_Correntista WHERE id=?";

    $stmt = $this->conexao->prepare($sql);
    $stmt->bindValue(1, $model->saldo);
    $stmt->bindValue(2, $model->tipo);
    $stmt->bindValue(3, $model->limite);
    $stmt->bindValue(4, $model->id_Correntista);

    return $stmt->execute();

  }

  public function selectById($id)
    {
        $sql = "SELECT c.*,
                        co.nome as nome_conta              
                FROM Conta c              
                JOIN Correntista co ON co.id = c.id_Correntista
                WHERE id = ?
                ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

  public function delete(int $id) : bool
  {
     $sql = "DELETE FROM Conta WHERE id = ?";

     $stmt = $this->conexao->prepare($sql);
     $stmt->bindValue(1, $id);
     return $stmt->execute();
  }
}