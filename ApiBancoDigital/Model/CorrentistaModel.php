<?php

namespace ApiBancoDigital\Model;

use ApiBancoDigital\DAO\CorrentistaDAO;
use ApiBancoDigital\DAO\ContaDAO;

class CorrentistaModel extends Model 
{
    public $id, $nome, $cpf, $senha, $data_nasc, $email;
    public $rows_contas= [];

    public function save() : ? CorrentistaModel
    {
        $dao_correntista = new CorrentistaDAO();

        $model_preenchido = $dao_correntista->save($this);

        if($model_preenchido->id != null)
        {
            $dao_conta = new ContaDAO();

            //abrindo conta corrente
            $conta_corrente = new ContaModel();
            $conta_corrente->id_Correntista = $model_preenchido->id;
            $conta_corrente->tipo = 'C';
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;
            
            //abrindo conta poupança
            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_Correntista = $model_preenchido->id;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }
        return $model_preenchido;
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

  public function login($cpf, $senha)
  {
    $dao = new CorrentistaDAO();

    $dados_correntista = $dao->getCorrentistaByCpfAndSenha($cpf, $senha);

    $dados_correntista->rows_contas = (new ContaDAO())->selectByIdCorrentista($dados_correntista->id);

    return $dados_correntista;
  }

  public function delete()
  {
    (new CorrentistaDAO())->delete($this->id);
  }
}