<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller
{
    public static function CorrentistaSalvar() : void
    {
      try
      {
        $json_obj = json_decode(file_get_contents('php://input')); //pegando conteúdo de um arquivo, decodificando para json e convertendo p/ uma variável

        $model = new CorrentistaModel();
        $model->id = $json_obj->Id;
        $model->nome = $json_obj->nome;
        $model->cpf = $json_obj->CPF;
        $model->senha = $json_obj->senha;

        parent::getResponseAsJSON($model->CorrentistaSalvar());
      }
      catch (Exception $e) 
      {
        parent::getExceptionAsJSON($e);
      }
    } 
   
    public static function auth()
    {
      $json_obj = parent::getJSONFromRequest();

      //var_dump($json_obj);

      $model = new CorrentistaModel();

      parent::getResponseAsJSON($model->auth($json_obj->Cpf, $json_obj->Senha));
    }
    

    public static function deletar() : void
    {
     
    }
}