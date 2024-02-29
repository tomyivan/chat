<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    use ResponseTrait;
    private $key;
    public function __construct()
    {
        $this->key = $_ENV["KEY_LANG"];          
    }
    public function createJwt($payload)
    {
        $token = JWT::encode($payload, $this->key,'HS256');
        return $token;        
    } 
    public function validationToken($token)
    {
        // $token  = $this->request->getHeaderLine('token');
        if(!$token)
        {
            $data = [
                "status" => 401,
                "error" => 401,
                "messages" =>[
                    "error"=> "No se proporcionó ningún token"
                ]
            ];
            return $data;
        }
        $responseJWT = $this->decodeJwt($token);
        if(!empty($responseJWT["error"]))
        {
            $data = [
                "status" => 401,
                "error" => 401,
                "messages" =>[
                    "error"=> "Token no valido"
                ]
            ];
            return $data;
        } 
        return $this->decodeJwt($token);
    }
    public function decodeJwt($token)
    {        
        try {    
            $decoded = JWT::decode($token, new Key($this->key,'HS256'));  
            $response = [
                "status" => 201,
                "error" => null,
                "message" => [
                    "success" => "Ok"
                ],
                "info" => $decoded
            ];
            return $response;
        } catch (Exception $e) {
            // El token es inválido
            $response = [
                "status" => 400,
                "error" => 400,
                "message" => [
                    "error" => "Token no valido"
                ]
            ];
            return $response;
        }
    }
}
