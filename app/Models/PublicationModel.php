<?php 
namespace App\Models;
use CodeIgniter\Model;
class PublicationModel extends Model{

    protected $table = 'publicaciones';
    protected $primaryKey = 'id_publicacion';    
    protected $allowedFields = ['id_categoria','mensaje','archivo','usuario_creacion','fecha_creacion','activo'];
}
?>