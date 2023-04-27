<?php

namespace ApiBancoDigital\Model;

use ApiBancoDigital\DAO\ContaDAO;

class ContaModel extends Model
{
    public $id, $numero, $tipo, $senha;

    public function ContaSalvar()
    {
       
        if($this->id == null)
        (new ContaDAO())->insert($this);
        else
        (new ContaDAO())->update($this);
    }

    public function getAllRows(string $query = null)
    {
        $this->rows = (new ContaDAO())->select(); 
    }

    public function delete()
    {
       (new ContaDAO())->delete($this->id);
    }
}