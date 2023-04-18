<?php

use ApiBancoDigital\Controller\CorrentistaController;

$url = parse_url($_SERVER[REQUEST_URI], PHP_URL_PATH);

switch ($url)
{
    //rota Correntista
    /**
     * Metódo: Post
     * http://10.0.2.2/correntista/save
     */
    case '/correntista/save':
        CorrentistaController::CorrentistaSave();
    break;
}