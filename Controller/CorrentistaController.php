<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\CorrentistaModel;
use ApiBancodigital\DAO;
use Exception;

class CorrentistaController extends Controller
{
    public static function save() : void
    {
      try
      {
        $json_obj = json_decode(file_get_contents('php://input')); //pegando conteúdo de um arquivo, decodificando para json e convertendo p/ uma variável

        $model = new CorrentistaModel();
        $model->id = $json_obj->Id;
        $model->nome = $json_obj->nome;
        $model->cpf = $json_obj->CPF;
        $model->data_nasc = $json_obj->data_nasc;
        $model->senha = $json_obj->senha;

        parent::getResponseAsJSON($model->save());
      }
      catch (Exception $e) 
      {
        parent::getExceptionAsJSON($e);
      }
    } 
   
    public static function login()
    {
      $json_obj = parent::getJSONFromRequest();

      $model = new CorrentistaModel();

      parent::getResponseAsJSON($model->login($json_obj->CPF, $json_obj->senha));
      
    }
    

    public static function delete()
    {
     
    }

    public static function update()
    {

    }

    public static function select()
    {

    }
}