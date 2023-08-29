<?php

use ApiBancoDigital\Controller\ContaController;
use ApiBancoDigital\Controller\CorrentistaController;
use ApiBancoDigital\Controller\TransacaoController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url)
{
    //rotas Correntista
    /**
     * Metódo: Post
     * http://10.0.2.2/correntista/salvar
     */
    case '/correntista/salvar':
        CorrentistaController::CorrentistaSalvar();
    break;

    case '/correntista/entrar':
        CorrentistaController::login();
    break;

    //rotas Conta
    case '/conta/save':
       ContaController::ContaSalvar();
    break;

    case '/conta/extrato':
        ContaController::Extrato();
     break;
    
    //rotas Chave Pix enviar e receber
    
    //rotas Transação
    case '/conta/pix/receber':
        ContaController::ReceberPix();
    break;

    case '/conta/pix/enviar':
    ContaController::EnviarPix();
    break;

    default: 
    header('erro');
    //http_response_code 403
    break;
}