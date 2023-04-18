<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller
{
    public static function CorrentistaSave() : void
    {
      try
      {
        $json_obj = json_decode(file_get_contents('php://input')); //pegando conteúdo de um arquivo, decodificando para json e convertendo p/ uma variável

        model = new CorrentistaModel();
        $model->id = json_obj->Id;
        $model->nome = json_obj->Nome;
        $model->cpf = json_obj->CPF;
        $model->senha = json_obj->Senha;

        $model->save();
      }
      catch (Exception $e) 
      {
        parent::getExceptionAsJSON($e);
      }
    } 
}