<?php

namespace ApiBancoDigital\Controller;
use Exception;

abstract class Controller
{

      protected static function isAuthenticated(Exception $e)
      {
        if(!isset($_SESSION['user']))
        header("Location: /login");
      }

     

      public static function getJSONFromRequest()
      {
        return json_decode(file_get_contents("php://input"));
        
      }
     
      protected static function getResponseAsJSON($data)
      {
        header("Acess-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));
      }

      protected static function setResponseAsJSON($data, $request_status = true)
      {
        $response = array('response_data' => $data, 'response_sucessful' =>$request_status);
          
        header("Acess-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($response));
      }

      protected static function getExceptionASJSON(Exception $e)
      {
        $exception = [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'traceAsString' => $e->getTraceAsString(),
            'previous' => $e->getPrevious()
        ];

        http_response_code(400);

        header("Acess-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");
         
        exit(json_encode($exception));
      }

      protected static function isGet()
      {
        if($_SERVER['REQUEST_METHOD'] !== 'GET')
          throw new Exception("O método de requisição dever ser GET");
      }

      protected static function isPost()
      {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') 
          throw new Exception("O método de requisição dever ser POST");
      }

      protected static function getIntFromUrl($var_get, $var_name = null) : int
      {
        self::isGet();

        if(!empty($var_get))
           return (int) $var_get;
        else 
           throw new Exception("variável $var_name não idenficada.");
      }

      protected static function getStringFromUrl($var_get, $var_name = null) : string
      {
        self::isGet();

        if(!empty($var_get))
            return (string) $var_get;
        else
          throw new Exception("variável $var_name não identificada.");
      }
}