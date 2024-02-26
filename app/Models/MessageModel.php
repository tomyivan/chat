<?php 
namespace App\Models;
use CodeIgniter\Model;
class MessageModel extends Model{

    protected $table = 'mensajes';
    protected $primaryKey = 'id_mensaje';    
    protected $allowedFields = ['dni_emisor','mensaje','dni_receptor','fecha_creacion','activo'];
}
?>