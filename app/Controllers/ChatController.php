<?php

namespace App\Controllers;
use App\Models\MessageModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
class ChatController extends ResourceController
{
    use ResponseTrait;
    private $messageModel;
    private $dateNow;
    public function __construct()
    {   
        $this->dateNow = date("Y-m-d H:i:s"); ;
        $this->messageModel = new MessageModel();
        helper(['form']);
    }
    public function storeMessage()
    {        
        $status = 400;
        $error = 400;
        $rules = [
            'dni_emi' => 'required',
            'message' => 'required',
            'dni_rec' => 'required', 
        ];          
        $data = [
            "dni_emisor" => $this->request->getVar('dni_emi'),
            "mensaje" => $this->request->getVar('message'),
            "dni_receptor" => $this->request->getVar('dni_rec'),
            "fecha_creacion" => $this->dateNow,
            "activo" => 1
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $status = $this->messageModel->save($data);
        if($status)
        {
            $status = 201;
            $error = null;   
            $message = ["success"=>"Mensaje Guardado"];
        }else{
            $message = ["error" => "Ocurrio un Error"];
        }
        $response = [
            "status" => $status,
            "error" => $error,
            "message" => [
                $message
            ]
        ];
        
        return $this->respond($response);
    }
    
}
