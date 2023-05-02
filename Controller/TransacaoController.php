<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\TransacaoModel;
use Exception;

class TransacaoController extends Controller
{
    public static function TransacaoSalvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));
        }
    }
}