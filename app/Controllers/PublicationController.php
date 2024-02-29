<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\PublicationModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
class PublicationController extends ResourceController
{
    use ResponseTrait;
    private $publicationModel;
    private $dateNow;
    private $token;
    private $credential;
    private $categoryModel;
    public function __construct()
    {           
        $this->token = new AuthController();
        $this->dateNow = date("Y-m-d H:i:s"); ;
        $this->publicationModel = new PublicationModel();
        $this->categoryModel = new CategoryModel();
        helper(['form']);        
    }
    public function response($status = 400,$error= 400,$message = ["mensaje" => "No se pudo agregar la publicacion"],$info = null) :array
    {   
        $response = [
            "status" => $status,
            "error" => $error,
            "message" => [
                $message
            ],
            "info" => [
                $info
            ]
        ];
        return $response;
    }
    public function storePublication()
    {         
        $this->credential = $this->token->validationToken($this->request->getHeaderLine('token'));        
        if($this->credential["error"] == 401)
        {
            return $this->respond($this->credential);
        }
        $rules = [
            'detail' => 'required',
        ];    
        $data = [
            "mensaje" => $this->request->getVar('detail'),            
            "id_category" => 1,
            "fecha_creacion" => $this->dateNow,
            "usuario_creacion" => "323232",
            "activo" => 1
        ];      
        $response = $this->response();  
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        // $img = $this->request->getFile('file');
        // if(!$img->isValid())
        // {
           
        // }
        // if (!$img->hasMoved())
        // {
        //     $newName = $img->getRandomName();                
        //     $img->move("../public/uploadFile/publication", $newName);
        // }
        // $data['file'] = $this->request->getVar('file');
        $status = $this->publicationModel->save($data);
        if($status)
        {   
            $message = ["mensaje" => "Se agrego correctamente"];
            $response = $this->response(201,null,$message);
        }
        return $this->respond($response);
    }
    public function getCategory()
    {
        $this->credential = $this->token->validationToken($this->request->getHeaderLine('Authorization'));        
        if($this->credential["error"] == 401)
        {
            return $this->respond($this->credential);
        }
        $category = $this->categoryModel->where(['activo' => 1])->findAll();
        $response = $this->response(201,null,["success" => "ok"],$category);
        return $this->respond($response);
    }
    public function getPublication()
    {
        $this->credential = $this->token->validationToken($this->request->getHeaderLine('Authorization'));        
        if($this->credential["error"] == 401)
        {
            return $this->respond($this->credential);
        }        
        $publication = $this->publicationModel->where(['activo' => 1])->findAll();
        $response = $this->response(201,null,["success" => "ok"],$publication);
        return $this->respond($response);
    } 
    
}
