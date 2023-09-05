<?php  

namespace ApiBancoDigital\Model;

use Exception;

abstract class Model 
{
    // amarzena o array retornado da DAO com a listagem do(a) correntista, conta...
    public $rows = [];
}