<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\ContaModel;
use Exception;

class ContaController extends Controller
{
     public static function ContaSalvar() : void
     {
        try
        {
          $json_obj = json_decode(file_get_contents('php://input')); //pegando conteúdo de um arquivo, decodificando para json e convertendo p/ uma variável
  
          $model = new ContaModel();
          $model->id = $json_obj->Id;
          $model->numero = $json_obj->Numero;
          $model->tipo = $json_obj->Tipo;
          $model->senha = $json_obj->Senha;
  
          $model->ContaSalvar();
        }
        catch (Exception $e) 
        {
          parent::getExceptionAsJSON($e);
        }
     }
}