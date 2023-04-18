<?php

namespace ApiBancoDigital\Model;
use Api\DAO\CorrentistaDAO;

class CorrentistaModel extends Model 
{
    public $id, $nome, $cpf, $senha;

    public function CorrentistaSave() 
    {
        if($this->id == null)
        (new CorrentistaDAO())->insert($this);
        else
        (new CorrentistaDAO())->update($this);
    }
}