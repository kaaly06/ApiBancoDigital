<?php

namespace ApiBancoDigital\DAO;

use ApiBancoDigital\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select()
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

       return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

    public function insert(CorrentistaModel $m) : bool
    {
        $sql = "INSERT INTO correntista (nome, CPF, data_nasc) VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->cpf);
        $stmt->bindValue(3, $m->senha);
        $stmt->bindValue(4, $m->id);

        return $stmt->execute();
    }

    public function update(CorrentistaModel $m)
    {
        $sql = "UPDATE correntista SET nome=?, cpf=? senha=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
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