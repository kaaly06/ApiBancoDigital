<?php

use ApiBancoDigital\Controller\CorrentistaController;

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

    //rotas Conta
    case '/conta/save':
        ContaController::ContaSalvar();
    break;
    //rotas Chave Pix
    //rotas Transação
}