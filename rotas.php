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
    case '/correntista/save':
        CorrentistaController::CorrentistaSalvar();
    break;

    case '/correntista/save':
        CorrentistaController::CorrentistaEntrar();
    break;

    //rotas Conta
    case '/conta/save':
       ContaController::ContaSalvar();
    break;
    
    //rotas Chave Pix enviar e receber
    
    //rotas Transação
    case '/transacao/save':
        TransacaoController::TransacaoSalvar();
    break;
}