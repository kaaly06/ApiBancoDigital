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
        $model->usuario = $json_obj->Usuario;
        $model->cpf = $json_obj->CPF;
        $model->senha = $json_obj->Senha;

        $model->CorrentistaSalvar();
      }
      catch (Exception $e) 
      {
        parent::LogError($e);
        parent::getExceptionAsJSON($e);
      }
    } 
   
    public static function CorrentistaEntrar() : void
    {
        $model = new CorrentistaModel();

        $model->usuario = $_POST['usuario'];
        $model->senha = $_POST['senha'];

        $usuario_logado = $model->autenticar();

        if ($usuario_logado !==null) {
          $_SESSION['usuario_logado'] = $usuario_logado;

          header("Location: /login?erro=true");
        }
    }

    public static function deletar() : void
    {
      try
      {
        $id = json_decode(file_get_contents('php://input'));

        (new CorrentistaModel())->delete( (int) $id);
      }catch (Exception $e)
      {
        parent::LogError($e);
        parent::getExceptionASJSON($e);
      }
    }
}