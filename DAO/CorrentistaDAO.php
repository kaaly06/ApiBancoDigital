<?php

namespace ApiBancoDigital\DAO;

use ApiBancoDigital\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select() : array
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

       return $stmt->fetchAll(DAO::FETCH_CLASS, "ApiBancoDigital\Model\CorrentistaModel");
    }
    
    public function insert(CorrentistaModel $m) : CorrentistaModel
    {
        $sql = "INSERT INTO correntista (usuario, CPF, data_nasc) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->usuario);
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
        $stmt->bindValue(1, $m->usuario);
        $stmt->bindValue(2, $m->cpf);
        $stmt->bindValue(3, $m->senha);
        $stmt->bindValue(4, $m->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}