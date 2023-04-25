<?php

namespace ApiBancodigital\DAO;

use ApiBancoDigital\Model\ContaModel;
use ApiBancoDigital\Model\Model;

class ContaDAO extends DAO
{
  public function __construct()
  {
     parent::__construct();
  }
  
  public function select()
  {
     $sql = "SELECT * FROM conta";

     $stmt = $this->conexao->prepare($sql);
     $stmt->execute();

     return $stmt->fetchAll(DAO::FETCH_CLASS);
  }

  public function insert(ContaModel $m) : bool
  {
     $sql = "INSERT INTO conta (numero, tipo, senha) VALUES (?, ?, ?)";

     $stmt = $this->conexao->prepare($sql);
     $stmt->bindValue(1, $m->numero);
     $stmt->bindValue(2, $m->tipo);
     $stmt->bindValue(3, $m->senha);
     $stmt->bindValue(4, $m->id);

     return $stmt->execute();

  }

  public function update(ContaModel $m)
  {   
    $sql = "UPDATE conta SET numero=?, tipo=? senha=? WHERE id=?";

    $stmt = $this->conexao->prepare($sql);
    $stmt->bindValue(1, $m->numero);
    $stmt->bindValue(2, $m->tipo);
    $stmt->bindValue(3, $m->senha);
    $stmt->bindValue(4, $m->id);

    return $stmt->execute();

  }

  public function delete()
  {

  }



}