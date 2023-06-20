<?php

namespace ApiBancoDigital\Model;

use ApiBancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model 
{
    public $id, $usuario, $cpf, $senha;

    public function CorrentistaSalvar() 
    {
        if($this->id == null)
        return (new CorrentistaDAO())->insert($this);
    else
        (new CorrentistaDAO())->update($this);
    }
    
    public function getAllRows()
    {
        $this->rows = (new CorrentistaDAO())->select();
    }

    public function getById(int $id)
    {
        $dao = new CorrentistaDAO();

		$this->rows = $dao->selectById($id);
    }

    public function  auth($cpf, $senha)
    {
		
        $dao = new CorrentistaDAO();

		return $dao->getCorrentistaByCpfAndSenha($cpf, $senha);		
	}

    public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }
}