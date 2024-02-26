<?php

namespace App\Controllers;
use App\Models\MessageModel;

use CodeIgniter\API\ResponseTrait;
class ChatController extends BaseController
{
    use ResponseTrait;
    private $messageModel;
    public function __construct()
    {   
        $this->messageModel = new MessageModel();
    }
    public function storeMessage()
    {
        $request = service('request');
        $nombre = $request->getPost('nombre');
        $apellido = $request->getPost('apellido');        
        $data = $this->messageModel->findAll();
        
        return $this->respond($data);
     }
}
