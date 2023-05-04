<?php

namespace ApiBancoDigital\Model;

use ApiBancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model 
{
    public $id, $usuario, $cpf, $senha;

    public function CorrentistaSalvar() 
    {
        if($this->id == null)
        (new CorrentistaDAO())->insert($this);
        else
        (new CorrentistaDAO())->update($this);
    }

    public function autenticar()
    {
        $dao = new LoginDAO();

        $dados_usuario_logado = $dao->selectByUsuarioAndSenha($this->usuario, $this->senha);

        if(is_object($dados_usuario_logado))
          return $dados_usuario_logado;
        else 
           null;
    }
    
    public function getAllRows()
    {
        $this->rows = (new CorrentistaDAO())->select(); 
    }

    public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }
}